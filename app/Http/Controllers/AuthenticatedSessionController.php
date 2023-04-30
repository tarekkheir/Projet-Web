<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function showForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string'
        ]);

        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];
        $user = User::where('login', $credentials['login'])->get();
        
        if (sizeof($user) > 0 && $user[0]->type == NULL) {
            return back()->withErrors([
                'login' => 'Votre compte n\'a pas encore été validé',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session()->flash('etat','Login successful');
            
            return redirect()->route(auth()->user()->type.'.home');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
