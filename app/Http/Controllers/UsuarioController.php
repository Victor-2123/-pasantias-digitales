<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        // Enforce admin only (already middleware but good to be sure)
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $search = $request->input('search');

        $users = User::when($search, function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get(); // Using get() since the view uses $users->count() and loop

        return view('usuarios.index', compact('users', 'search'));
    }

    public function changeRole(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin() || auth()->id() === $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'user_type' => 'required|string|in:estudiante,maestro,administrador',
        ]);

        $user->update(['user_type' => $validated['user_type']]);

        return redirect()->route('usuarios.index')->with('success', "Rol de {$user->name} actualizado.");
    }

    public function toggleSuspend(User $user)
    {
        if (!auth()->user()->isAdmin() || auth()->id() === $user->id) {
            abort(403);
        }

        $user->update(['is_suspended' => !$user->is_suspended]);

        $status = $user->is_suspended ? 'suspendido' : 'reactivado';
        return redirect()->route('usuarios.index')->with('success', "Usuario {$user->name} {$status}.");
    }
}
