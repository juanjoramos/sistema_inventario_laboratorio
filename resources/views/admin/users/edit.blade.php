<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Editar Usuario
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md border border-gray-200 max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       placeholder="Nombre completo" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo institucional</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       placeholder="ejemplo@pascualbravo.edu.co" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nueva Contraseña (opcional)</label>
                <input type="password" 
                       name="password" 
                       placeholder="********" 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Nueva Contraseña</label>
                <input type="password" 
                       name="password_confirmation" 
                       placeholder="********" 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Asignar Roles</label>
                <div class="space-y-2">
                    @foreach($roles as $role)
                        <label class="flex items-center gap-2 text-gray-700">
                            <input type="checkbox" 
                                   name="roles[]" 
                                   value="{{ $role->id }}"
                                   class="rounded text-[#293a52] focus:ring-[#293a52]"
                                   {{ (is_array(old('roles', $user->roles->pluck('id')->toArray())) 
                                        && in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))) 
                                        ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-[#293a52] hover:bg-[#1e2c42] text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
