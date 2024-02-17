<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
        return redirect()->route('login');
    }
        return view('home');
    }

    public function createPost(Request $request)
{
    $validatedData = $request->validate([
        'post_content' => 'required',
        'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'selected_gif_url' => 'nullable|url',
    ]);

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $username = Auth::user()->username;
    $postContent = $validatedData['post_content'];
    $postImage = null;

    if ($request->hasFile('post_image')) {
        $uploadedFile = $request->file('post_image');
        $postImage = $uploadedFile->store('public/uploads');

        DB::table('posts')->insert([
            'username' => $username,
            'post_content' => $postContent,
            'post_image' => url('storage/uploads/' . basename($postImage)),
        ]);

    } elseif ($request->filled('selected_gif_url')) {
        $postImage = $validatedData['selected_gif_url'];
        DB::table('posts')->insert([
            'username' => $username,
            'post_content' => $postContent,
            'post_image' => $postImage,
        ]);
    }

    else{
      DB::table('posts')->insert([
         'username' => $username,
         'post_content' => $postContent,
         'post_image' => null,
     ]);
   }

    return redirect()->route('home');
}

}
