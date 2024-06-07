<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero; // Importer le modèle Hero

class RechercherHeroesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $heroes = Hero::where('name', 'LIKE', "%$query%")->get();

        return view('rechercherheroes', compact('heroes'));
    }
}