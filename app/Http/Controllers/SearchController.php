<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has('search')) {
            $searchQuery = $request->input('search');

            $searchResults = DB::table('users')
                ->where('username', 'LIKE', '%' . $searchQuery . '%')
                ->get();

            return view('search', compact('searchResults')); //compact crea un array che contiene variabili e loro valori (il nome della variabile viene passato come stringa)
        }

        return view('search');
    }
}
