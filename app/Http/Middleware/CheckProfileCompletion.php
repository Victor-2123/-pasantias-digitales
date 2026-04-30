<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only enforce for authenticated students
        if ($user && $user->user_type === 'estudiante') {
            // Se ha desactivado la redirección obligatoria por petición del usuario.
            // El usuario podrá completar su perfil voluntariamente desde la vista de perfil.
            /*
            if (!$user->is_profile_complete && !$request->routeIs('onboarding.*') && !$request->is('logout')) {
                return redirect()->route('onboarding.index');
            }
            */
        }

        return $next($request);
    }
}
