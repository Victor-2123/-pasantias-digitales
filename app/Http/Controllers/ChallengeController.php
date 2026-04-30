<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Career;
use App\Models\Company;
use App\Models\LearningPath;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $query = Challenge::with('career')->orderBy('created_at', 'desc');

        if (!auth()->user()->isAdmin()) {
            $query->where('mentor_id', auth()->id());
        }

        $challenges = $query->get();

        return view('challenges.manage', compact('challenges'));
    }

    public function create()
    {
        $careers = Career::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        $learningPaths = LearningPath::orderBy('title')->get();

        return view('challenges.create', compact('careers', 'companies', 'learningPaths'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'company_id' => 'nullable|exists:companies,id',
            'learning_path_id' => 'nullable|exists:learning_paths,id',
            'difficulty' => 'required|string|in:Básico,Intermedio,Avanzado',
            'expires_at' => 'nullable|date',
        ]);

        $validated['mentor_id'] = auth()->id();

        Challenge::create($validated);

        return redirect()->route('challenges.manage')->with('success', 'Reto creado exitosamente.');
    }

    public function edit(Challenge $challenge)
    {
        // Enforce ownership or admin
        if ($challenge->mentor_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $careers = Career::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        $learningPaths = LearningPath::orderBy('title')->get();

        return view('challenges.edit', compact('challenge', 'careers', 'companies', 'learningPaths'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        if ($challenge->mentor_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'company_id' => 'nullable|exists:companies,id',
            'learning_path_id' => 'nullable|exists:learning_paths,id',
            'difficulty' => 'required|string|in:Básico,Intermedio,Avanzado',
            'expires_at' => 'nullable|date',
        ]);

        $challenge->update($validated);

        return redirect()->route('challenges.manage')->with('success', 'Reto actualizado exitosamente.');
    }

    public function destroy(Challenge $challenge)
    {
        if ($challenge->mentor_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $challenge->delete();
        return redirect()->route('challenges.manage')->with('success', 'Reto eliminado exitosamente.');
    }
}
