<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->roles->contains('name', 'admin')) {
            abort(403, 'Acceso denegado: solo administradores.');
        }

        return $next($request);
    }
}
