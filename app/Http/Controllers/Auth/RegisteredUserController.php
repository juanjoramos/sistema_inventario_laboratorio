<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; // 👈 asegúrate de importar tu modelo Role
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔹 Validación única
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[A-Za-z0-9._%+-]+@pascualbravo\.edu\.co$/i', // 👈 solo institucional
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 🔹 Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 🔹 Asignar rol automáticamente según el correo
        if (preg_match('/[0-9]+@pascualbravo\.edu\.co$/i', $user->email)) {
            // contiene números → estudiante
            $user->role_id = Role::where('name', 'estudiante')->first()->id;
        } else {
            // no contiene números → profesor
            $user->role_id = Role::where('name', 'profesor')->first()->id;
        }

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}