<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Hero::all(); // Récupérez les héros depuis votre modèle
        return view('home', ['heroes' => $heroes]); // Passez les héros à la vue
    }
}