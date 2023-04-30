<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home() {
        $id = auth()->user()->id;
        return view(auth()->user()->type.'.home', ['id' => $id]);
    }

    // Liste des users non-enregistrés
    public function demandes() {
        $users = User::where('type', NULL)->get();
        return view('admin.demandes', ['users' => $users]);
    }

    // MAJ type de compte
    public function updateType(Request $request) {
        $request->validate([
            'type' => 'required|in:etudiant,enseignant'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->type = $request->type;
        $user->save();
   
        session()->flash('etat','User added');
        
        return back()->with('message', $request->login.' ajouté !');
    }

    // Refuser/Supprimer un utilisateur
    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }

    // Formulaire changement de MDP
    public function editPassword() {
        return view('user.updatePassword');
    }
    
    // Changement MDP
    public function updatePassword(Request $request) {
        $request->validate([
            'old_mdp' => 'required',//min:8
            'new_mdp' => 'required|confirmed',//min:8
        ]);

        if (!Hash::check($request->old_mdp, auth()->user()->mdp)) {
            return back()->with('message', 'wrong password'); 
        }
        
        $user = User::find(auth()->user()->id);
        $user->mdp = Hash::make($request->new_mdp);
        $user->save();

        session()->flash('message', 'Mdp modified');
        return back()->with('message', 'MDP modified successfully');
    }

    // Formulaire changement Nom/Prénom
    public function editName() {
        $user = User::findOrFail(auth()->user()->id);
        return view('user.updateName', ['user' => $user]);
    }

    // Changement Nom/Prénom
    public function updateName(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->save();
   
        session()->flash('etat','User added');
        
        return back()->with('message', $request->login.' modifié !');
    }
}
