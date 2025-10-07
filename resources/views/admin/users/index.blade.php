<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Gestión de Usuarios
            </h2>
        </div>
    </x-slot>

    <div class="p-6" x-data="{ openModalId: null }">
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-2">
                <input type="text" name="email" placeholder="Buscar por correo..."
                    value="{{ request('email') }}"
                    class="border border-gray-300 dark:border-gray-700 rounded px-3 py-2 w-64 dark:bg-gray-800 dark:text-white" />
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    🔍 Buscar
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
                    Limpiar
                </a>
            </form>

            <div class="flex gap-2">
                <a href="{{ route('users.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
                    ➕ Crear Usuario
                </a>
                <a href="{{ route('admin.auditoria') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded flex items-center gap-1">
                    🕵️‍♂️ Auditoría
                </a>
            </div>
        </div>

        <div class="shadow-md rounded-lg overflow-hidden" style="background-color:#293a52">
            <table class="min-w-full text-sm text-left text-gray-800 dark:text-gray-200">
                <thead class="bg-blue-200 dark:bg-blue-800 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Correo</th>
                        <th class="px-4 py-2 border">Roles</th>
                        <th class="px-4 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="border px-4 py-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                        ✏️ Editar
                                    </a>

                                    <button 
                                        @click="openModalId = {{ $user->id }}" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        🗑️ Eliminar
                                    </button>

                                    <!-- Modal de confirmación -->
                                    <div 
                                        x-show="openModalId === {{ $user->id }}" 
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                        x-cloak>
                                        
                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Confirmar eliminación
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-300">
                                                ¿Estás seguro de que deseas eliminar al usuario <strong>{{ $user->name }}</strong>? Esta acción no se puede deshacer.
                                            </p>

                                            <div class="mt-4 flex justify-end gap-3">
                                                <button 
                                                    @click="openModalId = null"
                                                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                                                    Cancelar
                                                </button>

                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin del modal -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-4 text-gray-500 dark:text-gray-400">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 px-4 py-2">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>