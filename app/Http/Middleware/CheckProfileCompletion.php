<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Redirection disabled per user request to allow direct access to dashboard
        /*
        if (auth()->check() && auth()->user()->user_type === 'estudiante' && !auth()->user()->is_profile_complete) {
            return redirect()->route('onboarding.index');
        }
        */

        return $next($request);
    }
}
