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
        
    }

}
