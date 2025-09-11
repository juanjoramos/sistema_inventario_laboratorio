<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInstitutionalEmail
{
    public function handle(Request $request, Closure $next)
    {
        $email = $request->input('email');

        if (!str_ends_with($email, '@pascualbravo.edu.co')) {
            return back()->withErrors([
                'email' => 'Debes iniciar sesión con tu correo institucional.',
            ]);
        }

        return $next($request);
    }
}
