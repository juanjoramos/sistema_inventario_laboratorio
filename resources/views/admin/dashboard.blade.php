<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Administrador 🛠️
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Bienvenido Administrador 🛠️</h1>

                <div class="mb-4 flex gap-3">
                    <a href="{{ route('items.index') }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        📦 Ver Inventario Completo
                    </a>
                    <a href="{{ route('items.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                        ➕ Agregar Ítem
                    </a>
                    <a href="{{ route('admin.reservas.index') }}" 
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow">
                    📋 Ver Reservas Pendientes
                    </a>
                </div>

                @if($items->isEmpty())
                    <div class="p-4 bg-blue-100 text-blue-700 rounded-md">
                        No hay ítems con bajo stock actualmente.
                    </div>
                @else
                    <!-- Resumen rápido -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nombre</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Cantidad</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Umbral mínimo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $item->nombre }}</td>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $item->cantidad }}</td>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $item->umbral_minimo }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('items.editStock', $item) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">
                                                ✏️ Actualizar Stock
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
