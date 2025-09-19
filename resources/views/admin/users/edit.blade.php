<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar Usuario</h2>
    </x-slot>

    <div class="p-6">
        {{-- Bloque para mostrar mensajes de error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       placeholder="Nombre" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Email --}}
            <div>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       placeholder="Correo institucional (@pascualbravo.edu.co)" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Contraseña (opcional) --}}
            <div>
                <input type="password" 
                       name="password" 
                       placeholder="Nueva Contraseña (opcional)" 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Confirmación (opcional) --}}
            <div>
                <input type="password" 
                       name="password_confirmation" 
                       placeholder="Confirmar Nueva Contraseña" 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Roles --}}
            <div class="mt-2">
                <label class="font-semibold">Roles:</label><br>
                @foreach($roles as $role)
                    <label class="block">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                            {{ (is_array(old('roles', $user->roles->pluck('id')->toArray())) 
                                && in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))) 
                                ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                @endforeach
            </div>

            {{-- Botón --}}
            <button type="submit" 
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Actualizar
            </button>
        </form>
    </div>
</x-app-layout>
