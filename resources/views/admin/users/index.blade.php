<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Usuarios</h2>
    </x-slot>

    <div class="p-6">

        <!-- 🔍 Formulario de búsqueda por correo -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
            <input type="text" name="email" placeholder="Buscar por correo"
                value="{{ request('email') }}"
                class="border rounded px-3 py-1 w-1/3" />
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded ml-2">Buscar</button>
                <a href="{{ route('admin.users.index') }}"
            class="bg-blue-600 text-white px-3 py-1 rounded ml-2">
                Limpiar
            </a>
        </form>

        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">+ Crear Usuario</a>
        <a href="{{ route('admin.auditoria') }}" class="bg-gray-700 text-white px-3 py-1 rounded ml-2">Ver Historial de Auditoría</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Nombre</th>
                    <th class="border px-2 py-1">Correo</th>
                    <th class="border px-2 py-1">Roles</th>
                    <th class="border px-2 py-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border px-2 py-1">{{ $user->id }}</td>
                        <td class="border px-2 py-1">{{ $user->name }}</td>
                        <td class="border px-2 py-1">{{ $user->email }}</td>
                        <td class="border px-2 py-1">
                            {{ $user->roles->pluck('name')->join(', ') }}
                        </td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="bg-red-600 text-white px-2 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
