<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function index()
    {
        return view('onboarding.wizard');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'bio' => 'nullable|string',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update(array_merge($validated, ['is_profile_complete' => true]));

        return redirect()->route('dashboard')->with('success', '¡Perfil completado!');
    }
}
