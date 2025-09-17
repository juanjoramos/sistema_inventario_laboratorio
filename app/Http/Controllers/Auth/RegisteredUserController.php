<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar el formulario de registro
     */
    public function create(): View
    {
        return view('auth.register'); // formulario de registro
    }

    /**
     * Manejar la solicitud de registro de un nuevo usuario
     *
     * @throws ValidationException
     */
    public function store(Request $request)
{
    // Validación básica
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],
        'roles' => ['required', 'array', 'min:1'],
    ]);

    $email = $request->email;

    // ✅ Validar dominio institucional
    if (!preg_match('/@pascualbravo\.edu\.co$/i', $email)) {
        return back()->withErrors([
            'email' => 'Solo se permiten correos institucionales (@pascualbravo.edu.co).',
        ])->withInput();
    }

    $roles = $request->roles;

    // ✅ Si selecciona "ambas", se ignoran las validaciones de formato
    if (in_array('ambas', $roles)) {
        $roles = ['profesor', 'estudiante']; // asignamos ambos roles
    } else {
        // 🔍 Validación de formato SOLO si NO es ambas
        $esEstudianteEmail = preg_match('/^[a-z]+\.[a-z]+\d{3}@pascualbravo\.edu\.co$/i', $email);
        $esProfesorEmail   = preg_match('/^[a-z]+\.[a-z]+@pascualbravo\.edu\.co$/i', $email);

        if (in_array('estudiante', $roles) && !$esEstudianteEmail) {
            return back()->withErrors([
                'email' => 'El correo de estudiante debe tener tres números antes del @ (ejemplo: juan.ramos123@pascualbravo.edu.co).',
            ])->withInput();
        }

        if (in_array('profesor', $roles) && !$esProfesorEmail) {
            return back()->withErrors([
                'email' => 'El correo de profesor no debe contener números (ejemplo: jose.agudelo@pascualbravo.edu.co).',
            ])->withInput();
        }
    }

    // Crear usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $email,
        'password' => Hash::make($request->password),
    ]);

    // Asignar roles
    foreach ($roles as $role) {
        $user->assignRole($role);
    }

    Auth::login($user);

    // Redirigir según roles
    return count($roles) === 1
        ? $this->redirectByRole($roles[0])
        : redirect()->route('dashboard.selector');
}


    /**
     * Redirigir al dashboard según el rol del usuario
     *
     * @param string $roleName
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectByRole(string $roleName)
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
}
