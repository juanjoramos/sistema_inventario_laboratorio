<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSelectorController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('roles'); //Cargar usuario con roles
        return view('seleccionar-rol', compact('user'));
    }

public function submit(Request $request)
{
    $request->validate([
        'role' => 'required|string'
    ]);

    $user = Auth::user();

    // Validar que el rol pertenece al usuario
    if (!$user->roles->contains('name', $request->role)) {
        abort(403, 'No tienes este rol');
    }

    // Guardar en sesión el rol seleccionado
    session(['rol_activo' => $request->role]);

    // Redirigir según rol
    switch ($request->role) {
        case 'profesor':
            return redirect()->route('dashboard.profesor');
        case 'estudiante':
            return redirect()->route('dashboard.estudiante');
        case 'admin':
            return redirect()->route('dashboard.admin');
        default:
            return redirect()->route('dashboard');
    }
}

}
