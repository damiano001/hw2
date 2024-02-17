<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            $error = 'Invalid username or password';
            return view('login', compact('error'));
        }
    }
}
