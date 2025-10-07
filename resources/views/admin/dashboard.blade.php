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

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Total Ítems</div>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-300">{{ $totalItems }}</div>
                    </div>
                    <div class="text-blue-500 text-3xl">📦</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Ítems Bajo Stock</div>
                        <div class="text-3xl font-bold text-red-500 dark:text-red-300">{{ $lowStockCount }}</div>
                    </div>
                    <div class="text-red-500 text-3xl">⚠️</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Reservas Pendientes</div>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-300">{{ $reservasPendientes }}</div>
                    </div>
                    <div class="text-green-500 text-3xl">📋</div>
                </div>
            </div>

            <div class="rounded-lg shadow p-6 mb-10" style="background-color:#293a52">
                <div class="mb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">📉 Ítems con Bajo Stock</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('items.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow text-sm">
                            Ver Inventario Completo
                        </a>
                        <a href="{{ route('items.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow text-sm">
                            ➕ Agregar Ítem
                        </a>
                    </div>
                </div>

                @if ($items->isEmpty())
                    <div class="p-4 bg-blue-50 text-blue-700 rounded-md text-sm">
                        No hay ítems con bajo stock actualmente.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left border rounded-md overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">Cantidad</th>
                                    <th class="px-4 py-2">Umbral Mínimo</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-white">
                                @foreach ($items as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $item->nombre }}</td>
                                        <td class="px-4 py-2">{{ $item->cantidad }}</td>
                                        <td class="px-4 py-2">{{ $item->umbral_minimo }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('items.editStock', $item) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
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

            <div class="rounded-lg shadow p-6" style="background-color:#293a52">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">📋 Últimas Reservas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border rounded-md overflow-hidden">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-2">Usuario</th>
                                <th class="px-4 py-2">Ítem</th>
                                <th class="px-4 py-2">Cantidad</th>
                                <th class="px-4 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-white">
                            @forelse ($ultimasReservas as $reserva)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2">{{ $reserva->user->email }}</td>
                                    <td class="px-4 py-2">{{ $reserva->item->nombre }}</td>
                                    <td class="px-4 py-2">{{ $reserva->cantidad }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded 
                                            @if($reserva->estado == 'pendiente') bg-yellow-100 text-yellow-800 
                                            @elseif($reserva->estado == 'prestado') bg-blue-100 text-blue-800 
                                            @elseif($reserva->estado == 'devuelto') bg-purple-100 text-purple-800 
                                            @else bg-gray-200 text-gray-800 
                                            @endif">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-gray-500 italic text-center">No hay reservas recientes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
