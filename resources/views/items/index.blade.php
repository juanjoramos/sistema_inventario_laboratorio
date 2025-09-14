<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventario de Ítems
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <a href="{{ route('items.create') }}" 
                   class="inline-block mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    + Nuevo ítem
                </a>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Código</th>
                                <th class="px-4 py-2 text-left">Categoría</th>
                                <th class="px-4 py-2 text-left">Cantidad</th>
                                <th class="px-4 py-2 text-left">Ubicación</th>
                                <th class="px-4 py-2 text-left">Proveedor</th>
                                <th class="px-4 py-2 text-left">Fecha vencimiento</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                            @foreach ($items as $item)
                                <tr @if($item->cantidad <= $item->umbral_minimo) class="bg-red-100 dark:bg-red-700" @endif>
                                    <td class="px-4 py-2">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2">{{ $item->codigo }}</td>
                                    <td class="px-4 py-2">{{ $item->categoria }}</td>
                                    <td class="px-4 py-2">
                                        {{ $item->cantidad }}
                                        @if($item->cantidad <= $item->umbral_minimo && auth()->user()->hasRole('admin'))
                                            <span class="ml-2 px-2 py-1 bg-red-600 text-white rounded">¡Reabastecer!</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $item->ubicacion }}</td>
                                    <td class="px-4 py-2">{{ $item->proveedor }}</td>
                                    <td class="px-4 py-2">{{ $item->fecha_vencimiento }}</td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <!-- Editar -->
                                        <a href="{{ route('items.edit', $item->id) }}" 
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                                            Editar
                                        </a>

                                        <!-- Ver -->
                                        <a href="{{ route('items.show', $item->id) }}" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                                            Ver
                                        </a>

                                        <!-- Actualizar Stock -->
                                        <a href="{{ route('items.editStock', $item->id) }}" 
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded">
                                            Stock
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" 
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este ítem?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
