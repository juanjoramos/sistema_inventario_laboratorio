<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirige al login si no está autenticado
        }

        // Verifica si el usuario tiene el rol 'admin'
        $user = Auth::user();

        if (!$user->roles || !$user->roles->contains('name', 'admin')) {
            abort(403, 'Acceso denegado: solo administradores.');
        }

        return $next($request);
    }
}
