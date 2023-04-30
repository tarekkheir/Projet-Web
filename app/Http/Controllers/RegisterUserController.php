<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showForm(){
        $formations = Formation::all();
        return view('auth.register', ['formations' => $formations]);
    }

    public function store(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'formation_id' => 'required|integer',
            'login' => 'required|string|max:255|unique:users',
            'mdp' => 'required|string|confirmed|'//min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->formation_id = (strcmp($request->formation_id, "0") == 0 ? NULL
                                : $request->formation_id);
        $user->type = NULL;
        $user->save();
   
        session()->flash('etat','User added');
        return redirect()->route(auth()->user()->type.'.home');
    }
}
