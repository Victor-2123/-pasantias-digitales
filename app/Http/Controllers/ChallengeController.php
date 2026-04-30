<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Career;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChallengeController extends Controller
{
    /**
     * Display a listing of challenges for the mentor.
     */
    public function index()
    {
        $challenges = Challenge::where('mentor_id', auth()->id())
            ->with(['career', 'company'])
            ->latest()
            ->get();

        return view('challenges.manage', compact('challenges'));
    }

    /**
     * Show the form for creating a new challenge.
     */
    public function create()
    {
        $careers = Career::all();
        $companies = Company::all();
        return view('challenges.create', compact('careers', 'companies'));
    }

    /**
     * Store a newly created challenge in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'career_id'   => 'required|exists:careers,id',
            'company_id'  => 'nullable|exists:companies,id',
            'difficulty'  => 'required|in:Fácil,Intermedio,Avanzado',
            'expires_at'  => 'nullable|date|after:today',
        ]);

        $challenge = Challenge::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'career_id'   => $validated['career_id'],
            'company_id'  => $validated['company_id'],
            'mentor_id'   => auth()->id(),
            'difficulty'  => $validated['difficulty'],
            'expires_at'  => $validated['expires_at'],
            'order'       => Challenge::where('career_id', $validated['career_id'])->count() + 1,
        ]);

        return redirect()->route('challenges.manage')
            ->with('success', '¡Desafío creado exitosamente!');
    }

    /**
     * Show the form for editing the specified challenge.
     */
    public function edit(Challenge $challenge)
    {
        // Ensure only the mentor who created it can edit
        if ($challenge->mentor_id !== auth()->id()) {
            abort(403);
        }

        $careers = Career::all();
        $companies = Company::all();
        return view('challenges.edit', compact('challenge', 'careers', 'companies'));
    }

    /**
     * Update the specified challenge in storage.
     */
    public function update(Request $request, Challenge $challenge)
    {
        if ($challenge->mentor_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'career_id'   => 'required|exists:careers,id',
            'company_id'  => 'nullable|exists:companies,id',
            'difficulty'  => 'required|in:Fácil,Intermedio,Avanzado',
            'expires_at'  => 'nullable|date|after:today',
        ]);

        $challenge->update($validated);

        return redirect()->route('challenges.manage')
            ->with('success', 'Desafío actualizado correctamente.');
    }

    /**
     * Remove the specified challenge from storage.
     */
    public function destroy(Challenge $challenge)
    {
        if ($challenge->mentor_id !== auth()->id()) {
            abort(403);
        }

        $challenge->delete();

        return redirect()->route('challenges.manage')
            ->with('success', 'Desafío eliminado.');
    }
}
