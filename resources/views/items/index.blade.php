<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Inventario de Ítems 📦
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ openModalId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-md sm:rounded-lg p-6" style="background-color:#293a52">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('items.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        ➕ Nuevo ítem
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-blue-200 dark:bg-blue-800 text-gray-800 dark:text-white">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Código</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Cantidad</th>
                                <th class="px-4 py-3">Ubicación</th>
                                <th class="px-4 py-3">Proveedor</th>
                                <th class="px-4 py-3">Vencimiento</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                            @forelse ($items as $item)
                                <tr @if($item->cantidad <= $item->umbral_minimo) class="bg-red-50 dark:bg-red-800/50" @endif>
                                    <td class="px-4 py-2">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2">{{ $item->codigo }}</td>
                                    <td class="px-4 py-2">{{ $item->categoria }}</td>
                                    <td class="px-4 py-2">
                                        {{ $item->cantidad }}
                                        @if($item->cantidad <= $item->umbral_minimo && auth()->user()->hasRole('admin'))
                                            <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">
                                                ¡Reabastecer!
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $item->ubicacion }}</td>
                                    <td class="px-4 py-2">{{ $item->proveedor }}</td>
                                    <td class="px-4 py-2">{{ $item->fecha_vencimiento }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2 flex-wrap">
                                            <a href="{{ route('items.edit', $item->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                Editar
                                            </a>

                                            <a href="{{ route('items.show', $item->id) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                Detalles
                                            </a>

                                            <a href="{{ route('items.editStock', $item->id) }}" 
                                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                                                Stock
                                            </a>

                                            <button @click="openModalId = {{ $item->id }}" type="button" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <div 
                                                x-show="openModalId === {{ $item->id }}" 
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
                                                        ¿Estás seguro de que deseas eliminar <strong>{{ $item->nombre }}</strong>? Esta acción no se puede deshacer.
                                                    </p>

                                                    <div class="mt-4 flex justify-end gap-3">
                                                        <button 
                                                            @click="openModalId = null"
                                                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                                                            Cancelar
                                                        </button>

                                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
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
                                    <td colspan="8" class="text-center px-4 py-6 text-gray-500 dark:text-gray-400">
                                        No hay ítems en el inventario.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
