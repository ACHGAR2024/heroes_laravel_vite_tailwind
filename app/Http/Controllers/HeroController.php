<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Skill;
use App\Models\Universe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Hero::query();
        //$heroes = Hero::with(['skill', 'universe'])->get();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $heroes = $query->get();
        // dd($heroes);
        return view('heroes.index', compact('heroes'));
    }
    public function create()
    {
        $skills = Skill::all();
        $universes = Universe::all();
        return view('heroes.create', compact('skills', 'universes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'description' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'universe_id' => 'required|exists:universes,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $hero = new Hero($request->only(['name', 'gender', 'race', 'description', 'skill_id', 'universe_id']));

        if ($request->hasFile('photo')) {
            $hero->photo = $request->file('photo')->store('photos', 'public');
        }

        $hero->save();

        return redirect()->route('heroes.index')->with('success', 'Héros crée avec succès.');
    }
    public function show($id)
    {
        $hero = Hero::find($id);
        return view('heroes.show', compact('hero'));
    }
    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        $skills = Skill::all();
        $universes = Universe::all();

        return view('heroes.edit', compact('hero', 'skills', 'universes'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'description' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'universe_id' => 'nullable|exists:universes,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $hero = Hero::findOrFail($id);
        $hero->name = $request->input('name');
        $hero->gender = $request->input('gender');
        $hero->race = $request->input('race');
        $hero->description = $request->input('description');
        $hero->skill_id = $request->input('skill_id');
        $hero->universe_id = $request->input('universe_id');

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($hero->photo) {
                Storage::delete('public/' . $hero->photo);
            }
            // Store new photo
            $path = $request->file('photo')->store('photos', 'public');
            $hero->photo = $path;
        }

        $hero->save();

        return redirect()->route('heroes.index')->with('success', 'Héros mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $hero = Hero::find($id);
        $hero->delete();
        return redirect()->route('heroes.index')->with('success', 'Héro supprimé avec succès.');
    }

}