<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OnboardingController extends Controller
{
    /**
     * Show the onboarding wizard.
     */
    public function index()
    {
        return view('onboarding.wizard');
    }

    /**
     * Update the user's profile during onboarding.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'age'    => 'required|integer|min:15|max:100',
            'school' => 'required|string|max:255',
            'bio'    => 'required|string|max:1000',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->update([
            'age'    => $validated['age'],
            'school' => $validated['school'],
            'bio'    => $validated['bio'],
            'is_profile_complete' => true,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Perfil completado con éxito!');
    }
}
