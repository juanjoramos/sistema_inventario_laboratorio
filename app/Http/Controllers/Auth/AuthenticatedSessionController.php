<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    //Mostrar formulario de login
    public function create()
    {
        return view('auth.login');
    }

    //Procesar login
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = $request->email;
        $password = $request->password;

        // Validar dominio institucional
        if (!preg_match('/@pascualbravo\.edu\.co$/i', $email)) {
            return back()->withErrors([
                'email' => 'Solo se permiten correos institucionales.',
            ]);
        }

        // Buscar usuario
        $user = User::where('email', $email)->first();

        // Si no existe, crearlo automáticamente
        if (!$user) {
            $username = explode('@', $email)[0];

            // Definir rol según formato del correo
            if (preg_match('/^[a-zA-Z]+\.[a-zA-Z]+\d{3}@pascualbravo\.edu\.co$/i', $email)) {
                $roleName = 'estudiante';
            } else {
                $roleName = 'profesor';
            }

            // Crear usuario
            $user = User::create([
                'name' => ucfirst($username),
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            // Asignar rol
            $user->assignRole($roleName);
        }

        // Intentar login
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Si el usuario tiene más de un rol → redirigir al selector
            if ($user->roles->count() > 1) {
                return redirect()->route('dashboard.selector');
            }

            // Si solo tiene un rol → redirigir directo
            $roleName = $user->roles->first()->name;
            return $this->redirectByRole($roleName);
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ]);
    }

    //Redirigir según el rol
    private function redirectByRole($roleName)
    {
        switch ($roleName) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'profesor':
                return redirect()->route('dashboard.profesor');
            case 'estudiante':
                return redirect()->route('dashboard.estudiante');
            default:
                return redirect()->route('dashboard');
        }
    }

    //Cerrar sesión
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}