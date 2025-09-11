<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = $request->email;
        $password = $request->password;

        // ✅ Validar dominio institucional
        if (!preg_match('/@pascualbravo\.edu\.co$/i', $email)) {
            return back()->withErrors([
                'email' => 'Solo se permiten correos institucionales.',
            ]);
        }

        // Buscar usuario en BD
        $user = User::where('email', $email)->first();

        // ✅ Si no existe, crearlo automáticamente con rol correcto
        if (!$user) {
            $username = explode('@', $email)[0];
            $roleName = null;

            // 🔥 Estudiante: nombre.apellido + 3 números
            if (preg_match('/^[a-zA-Z]+\.[a-zA-Z]+\d{3}@pascualbravo\.edu\.co$/i', $email)) {
                $roleName = 'estudiante';
            } else {
                $roleName = 'profesor';
            }

            $roleId = Role::where('name', $roleName)->value('id');

            $user = User::create([
                'name' => ucfirst($username),
                'email' => $email,
                // ✅ Guardar la contraseña escrita por el usuario, encriptada
                'password' => bcrypt($password),
                'role_id' => $roleId,
            ]);
        }

        // ✅ Intentar login con credenciales ingresadas
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 🔀 Redirección según rol
            switch ($user->role_name) {
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

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
