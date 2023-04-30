<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    // Liste des formations
    public function liste() {
        $formations = Formation::paginate(10);
        return view(auth()->user()->type.'.formations', ['formations' => $formations]);
    }

    // Page d'ajout
    public function addForm() {
        return view('admin.addFormation');
    }
    
    // Ajout d'une Formation dans la DB
    public function store(Request $request) {
        $validate = $request->validate([
            'intitule' => 'required|max:30'
        ]);

        $nouveau = new Formation();
        $nouveau->intitule = $validate['intitule'];
        $nouveau->save();

        return back()->with('message', $nouveau->intitule.' ajouté !');
    }

    // Formaulaire de modification
    public function edit($id) {
        $formation = Formation::findOrFail($id);
        return view(auth()->user()->type.'.editFormation', ['formation' => $formation]);
    }

    // Modifier une formation
    public function modifier(Request $request, $id) {
        $validate = $request->validate([
            'intitule' => 'required',
        ]);

        $formation = Formation::findOrFail($id);
        $formation->intitule = $validate['intitule'];
        $formation->save();

        return back()->with('message', 'formation modifié !');
    }

    // Supprimer une formation
    public function supprimer($id) {
        $formation = Formation::findOrFail($id);
        $intitule = $formation->intitule;
        $cours = $formation->cours()->get();

        foreach($cours as $c) $c->delete();
        $formation->delete();

        return back()->with('message', $intitule.' supprimé !');
    }
}
