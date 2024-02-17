<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[0-9]/',
        ]);
    
        $username = $validatedData['username'];
        $email = strtolower($validatedData['email']);
        $password = Hash::make($validatedData['password']);
    
        try {
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->save();
    
            return redirect()->back()->with('success_msg', 'Registration successful');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
    

    
}
