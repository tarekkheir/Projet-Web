<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Formation;
use App\Models\Planning;
use App\Models\User;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    // Liste des cours
    public function liste() {
        $cours = Cour::paginate(10);
        return view(auth()->user()->type.'.cours', ['cours' => $cours]);
    }

    // Liste des cours d'une formation
    public function listeCoursFormation() {
        $formation = Formation::findOrFail(auth()->user()->formation_id);
        $cours = $formation->cours()->get();
        return view(auth()->user()->type.'.listeCoursFormation', ['cours' => $cours]);
    }

    // Liste des cours etudiant
    public function listeCoursEtudiant($id) {
        $user = User::findOrFail($id);
        $cours = $user->cours_users()->get();
        return view(auth()->user()->type.'.listeCoursEtudiant', ['cours' => $cours]);
    }

    // Liste des cours enseignant
    public function listeCoursEnseignant($id) {
        $user = User::findOrFail($id);
        $cours = $user->cours()->get();
        return view(auth()->user()->type.'.listeCours', ['cours' => $cours]);
    }

    // Formulaire inscription
    public function formulaireInscription() {
        $formation = Formation::findOrFail(auth()->user()->formation_id);
        $cours = $formation->cours()->get();
        return view('etudiant.inscription', ['cours' => $cours]);
    }

    // Inscription à un cours
    public function inscription(Request $request) {
        $validate = $request->validate([
            'cours_id' => 'required',
        ]);

        $cours = Cour::findOrFail($validate['cours_id']);
        $user = User::findOrFail(auth()->user()->id);

        foreach($user->cours_users()->get() as $cour) {
            if ($cour->id == $validate['cours_id']) {
                return back()->with('message', $cours->intitule.' déjà inscrit !');
            }
        }
        $user->cours_users()->attach($cours);
        $cours->save();

        return back()->with('message', $cours->intitule.' inscrit !');
    }

    // desinscription à un cours
    public function desinscription(Request $request) {
        $validate = $request->validate([
            'cours_id' => 'required',
        ]);

        $cours = Cour::findOrFail($validate['cours_id']);
        $user = User::findOrFail(auth()->user()->id);

        $user->cours_users()->detach($cours);

        return back()->with('message', $cours->intitule.' désinscrit !');
    }

    // Page d'ajout
    public function addCours() {
        $users = User::where('type', 'enseignant')->get();
        $formations = Formation::all();
        return view('admin.addCours', ['users' => $users, 'formations' => $formations]);
    }
    
    // Ajout d'un cours dans la DB
    public function store(Request $request) {
        $validate = $request->validate([
            'intitule' => 'required|max:30',
            'user_id' => 'required',
            'formation_id' => 'required'
        ]);

        $nouveau = new Cour();
        $nouveau->intitule = $validate['intitule'];
        $nouveau->user_id = $validate['user_id'];
        $nouveau->formation_id = $validate['formation_id'];
        $nouveau->save();

        return back()->with('message', $nouveau->intitule.' ajouté !');
    }

    // Formaulaire de modification
    public function edit($id) {
        $cours = Cour::findOrFail($id);
        $users = User::where('type', 'enseignant')->get();
        $formations = Formation::all();
        return view(auth()->user()->type.'.editCours', ['cours' => $cours, 'users' => $users, 'formations' => $formations]);
    }

    // Modifier un cours
    public function modifier(Request $request, $id) {
        $validate = $request->validate([
            'intitule' => 'required',
            'user_id' => 'required',
            'formation_id' => 'required'
        ]);

        $cours = Cour::findOrFail($id);
        $cours->intitule = $validate['intitule'];
        $cours->user_id = $validate['user_id'];
        $cours->formation_id = $validate['formation_id'];
        $cours->save();

        return back()->with('message', 'cours modifié !');
    }

    // Supprimer un cours
    public function supprimer($id) {
        $cours = Cour::findOrFail($id);
        $intitule = $cours->intitule;
        $cours_planning = Planning::where('cours_id', $cours->id)->get();
        foreach($cours_planning as $c) $c->delete();
        $cours->delete();
        return back()->with('message', $intitule.' supprimé !');
    }
}
