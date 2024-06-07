<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Skill::create($request->only('name'));

        return redirect()->route('skills.index')->with('success', 'Compétence ajoutée avec succès.');
    }

    public function show(Skill $skill)
    {
        return view('skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $skill->update($request->only('name'));

        return redirect()->route('skills.index')->with('success', 'Compétence mise à jour avec succès.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Compétence supprimée avec succès.');
    }
}