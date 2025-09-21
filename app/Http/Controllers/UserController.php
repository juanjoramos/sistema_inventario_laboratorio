<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

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
            'roles' => 'required|array'
        ], [
            'email.regex' => 'El correo debe ser institucional (@pascualbravo.edu.co).',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->sync($request->roles);

        Auditoria::create([
            'user_id'         => auth()->id(),
            'accion'          => 'crear',
            'modelo_afectado' => 'User',
            'modelo_id'       => $user->id,
            'descripcion'     => "Se creó el usuario {$user->name}",
            'datos_nuevos'    => array_merge(
                $user->toArray(),
                ['roles' => $user->roles->pluck('name')->toArray()]
            ),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $datos_anteriores = array_merge(
            $user->toArray(),
            ['roles' => $user->roles->pluck('name')->toArray()]
        );

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

        $datos_nuevos = array_merge(
            $user->fresh()->toArray(),
            ['roles' => $user->fresh()->roles->pluck('name')->toArray()]
        );

        Auditoria::create([
            'user_id'          => auth()->id(),
            'accion'           => 'actualizar',
            'modelo_afectado'  => 'User',
            'modelo_id'        => $user->id,
            'descripcion'      => "Se actualizó el usuario {$user->name}",
            'datos_anteriores' => $datos_anteriores,
            'datos_nuevos'     => $datos_nuevos,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy(User $user)
    {
        $datos_anteriores = array_merge(
            $user->toArray(),
            ['roles' => $user->roles->pluck('name')->toArray()]
        );

        $nombre = $user->name;

        $user->delete();

        Auditoria::create([
            'user_id'          => auth()->id(),
            'accion'           => 'eliminar',
            'modelo_afectado'  => 'User',
            'modelo_id'        => $user->id,
            'descripcion'      => "Se eliminó el usuario {$nombre}",
            'datos_anteriores' => $datos_anteriores,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito');
    }

    public function auditoria()
    {
        $logs = Auditoria::with('usuario')->latest()->paginate(20);
        return view('admin.users.auditoria', compact('logs'));
    }
}