<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Cour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    // Liste des séances pour l'enseignant
    public function planning() {
        $cours = Cour::where('user_id', auth()->user()->id)->get();
        $plannings = []; 
        foreach($cours as $cour) {
            $planning = Planning::where('cours_id', $cour->id)->get();
            foreach($planning as $p) {
                $plannings[$p->id] = $p;
            }
        }
        return view(auth()->user()->type.'.planning', ['plannings' => $plannings]);
    }

    // Formulaire d'ajout d'une séance
    public function formAjouterUneSeance() {
        $cours = Cour::where('user_id', auth()->user()->id)->get();
        return view('enseignant.ajouterUneSeance', ['cours' => $cours]);
    }

    // Ajouter une séance
    public function ajouterUneSeance(Request $request) {
        $validate = $request->validate([
            'cours_id' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);

        $nouveau = new Planning();
        $nouveau->cours_id = $validate['cours_id'];
        $nouveau->date_debut = date($validate['date_debut']);
        $nouveau->date_fin = date($validate['date_fin']);
        $nouveau->save();

        return back()->with('message', $nouveau->intitule.' séance ajouté !');
    }

    // Planning intégral étudiant
    public function planningIntegral() {
        $user = User::findOrFail(auth()->user()->id);
        $cours = $user->cours_users()->get();
        $plannings = [];

        foreach($cours as $cour) {
            $planning = Planning::where('cours_id', $cour->id)->get();
            foreach($planning as $p) {
                $plannings[$p->id] = $p;
            }
        }
        return view('etudiant.planningIntegral', ['plannings' => $plannings]);
    }

    // Planning semaine étudiant
    public function planningSemaine() {
        $user = User::findOrFail(auth()->user()->id);
        $cours = $user->cours_users()->get();
        $cours_id = [];
        
        foreach($cours as $c) {
            $cours_id[$c->id] = $c->id;
        }

        $plannings = Planning::whereIn('cours_id', $cours_id)->orderBy('date_debut')->get()->groupBy(function($date) {
            return Carbon::parse($date->date_debut)->format('W');
        });
        
        $dates = [];

        foreach($plannings as $planning) {
           $d = Carbon::createFromFormat('Y-m-d', explode('UTC', $planning[0]->date_debut)[0])->startOfWeek()->format('d-m-Y');
           $dates[$planning[0]->id] = $d;
        }

        return view('etudiant.planningSemaine', ['plannings' => $plannings,
                                                'dates' => $dates]);
    }

    // Choix du cours étudiant
    public function planningCoursListe() {
        $user = User::findOrFail(auth()->user()->id);
        $cours = $user->cours_users()->get();

        return view('etudiant.planningCoursListe', ['cours' => $cours]); 
    }

    // Planning par cours étudiant
    public function planningCours($id) {
        $cours = Cour::findOrFail($id);
        $plannings = $cours->plannings()->get();

        return view('etudiant.planningCours', ['plannings' => $plannings]); 
    }

    // Planning intégral Enseignant
    public function planningIntegralEnseignant() {
        $cours = Cour::where('user_id', auth()->user()->id)->get();
        $plannings = [];

        foreach($cours as $cour) {
            $planning = Planning::where('cours_id', $cour->id)->get();
            foreach($planning as $p) {
                $plannings[$p->id] = $p;
            }
        }
        return view('enseignant.planningIntegral', ['plannings' => $plannings]);
    }

    // Planning semaine Enseignant
    public function planningSemaineEnseignant() {
        $cours = Cour::where('user_id', auth()->user()->id)->get();
        $cours_id = [];
        
        foreach($cours as $c) {
            $cours_id[$c->id] = $c->id;
        }

        $plannings = Planning::whereIn('cours_id', $cours_id)->orderBy('date_debut')->get()->groupBy(function($date) {
            return Carbon::parse($date->date_debut)->format('W');
        });
        
        $dates = [];

        foreach($plannings as $planning) {
           $d = Carbon::createFromFormat('Y-m-d', explode('UTC', $planning[0]->date_debut)[0])->startOfWeek()->format('d-m-Y');
           $dates[$planning[0]->id] = $d;
        }

        return view('enseignant.planningSemaine', ['plannings' => $plannings,
                                                'dates' => $dates]);
    }

    // Choix du cours Enseignant
    public function planningCoursListeEnseignant() {
        $cours = Cour::where('user_id', auth()->user()->id)->get();

        return view('enseignant.planningCoursListe', ['cours' => $cours]); 
    }

    // Planning par cours Enseignant
    public function planningCoursEnseignant($id) {
        $cours = Cour::findOrFail($id);
        $plannings = $cours->plannings()->get();

        return view('enseignant.planningCours', ['plannings' => $plannings]); 
    }

    // Supprimer un cours
    public function supprimer($id) {
        $planning = Planning::findOrFail($id);
        $planning->delete();
        return back()->with('message', 'séance supprimé !');
    }

    // Formaulaire de modification
    public function edit($id) {
        $planning = Planning::findOrFail($id);
        return view(auth()->user()->type.'.edit', ['planning' => $planning]);
    }

    // Modifier une séance
    public function modifier(Request $request, $id) {
        $validate = $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);

        $planning = Planning::findOrFail($id);
        $planning->date_debut = $validate['date_debut'];
        $planning->date_fin = $validate['date_fin'];
        $planning->save();

        return back()->with('message', 'séance modifié !');
    }
}
