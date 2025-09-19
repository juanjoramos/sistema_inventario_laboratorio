<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**Listar todos los usuarios*/
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**Mostrar formulario de creación de usuario*/
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**Guardar nuevo usuario*/
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@pascualbravo\.edu\.co$/i',
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.regex' => 'El correo debe ser institucional (@pascualbravo.edu.co).',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /** Mostrar formulario de edición*/
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**Actualizar usuario*/
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**Eliminar usuario*/
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito');
    }
}
