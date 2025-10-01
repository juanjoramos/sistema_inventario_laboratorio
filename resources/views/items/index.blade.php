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

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-6">
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

                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar este ítem?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                    Eliminar
                                                </button>
                                            </form>
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
