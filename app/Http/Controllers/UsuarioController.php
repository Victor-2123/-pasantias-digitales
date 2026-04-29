<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * List users – only Admins may access.
     */
    public function index(Request $request)
    {
        abort_unless(auth()->user()->user_type === 'administrador', 403, 'Solo administradores pueden ver esta sección.');

        $query = User::query();

        // Search by name or email
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('usuarios.index', compact('users', 'search'));
    }

    /**
     * Change a user's role.
     */
    public function changeRole(Request $request, User $user)
    {
        abort_unless(auth()->user()->user_type === 'administrador', 403);

        $validated = $request->validate([
            'user_type' => 'required|in:estudiante,maestro,administrador',
        ]);

        $user->update(['user_type' => $validated['user_type']]);

        return back()->with('success', "Rol de {$user->name} actualizado.");
    }

    /**
     * Toggle a user's suspended state.
     */
    public function toggleSuspend(User $user)
    {
        abort_unless(auth()->user()->user_type === 'administrador', 403);

        $user->update(['is_suspended' => ! $user->is_suspended]);

        $action = $user->is_suspended ? 'suspendida' : 'reactivada';

        return back()->with('success', "Cuenta de {$user->name} {$action}.");
    }
}
