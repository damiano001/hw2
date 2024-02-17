<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
{
    $posts = Post::where('username', Auth::user()->username)
                 ->orderByDesc('created_at')
                 ->get();

    return view('profile', compact('posts')); //compact crea un array che contiene variabili e loro valori (il nome della variabile viene passato come stringa)
}

}
