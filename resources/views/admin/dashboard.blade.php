<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Bienvenido {{ auth()->user()->name }} 🛠️
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-md sm:rounded-lg p-6" style="background-color:#293a52; color:white;">
                <div class="mb-4 flex gap-3">
                    <a href="{{ route('items.index') }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        📦 Ver Inventario Completo
                    </a>
                    <a href="{{ route('items.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                        ➕ Agregar Ítem
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
                            <thead style="background-color:#293a52; color:white;">
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
