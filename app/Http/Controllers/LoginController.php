<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view("login");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials,$remember)) {
            if (Auth::user()->es_escritor) {
                return redirect()->route("admin.index")->with('success', 'You have been successfully logged in.');
            }
            else {
                return redirect()->route("usuario.dashboard")->with('success', 'You have been successfully logged in.');
            }
            return Auth::user();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout() {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Auth::logout();
        return redirect('/login')->with('success', 'You have been successfully logged out.');
    }

}
