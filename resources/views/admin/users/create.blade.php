<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Crear Usuario
            </h2>
        </div>
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

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            {{-- Nombre --}}
            <div>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Nombre" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Email --}}
            <div>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Correo institucional (@pascualbravo.edu.co)" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Contraseña --}}
            <div>
                <input type="password" 
                       name="password" 
                       placeholder="Contraseña" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Confirmación --}}
            <div>
                <input type="password" 
                       name="password_confirmation" 
                       placeholder="Confirmar Contraseña" 
                       required 
                       class="border rounded p-2 w-full mb-2">
            </div>

            {{-- Roles --}}
            <div class="mt-2">
                <label class="font-semibold">Roles:</label><br>
                @foreach($roles as $role)
                    <label class="block">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                            {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                @endforeach
            </div>

            {{-- Botón --}}
            <button type="submit" 
                    class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>
