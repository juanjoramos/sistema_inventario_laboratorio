<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de Ítem: {{ $item->nombre }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ mostrar: 'transacciones' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                
                {{-- Detalles del ítem --}}
                <div class="mb-6 text-white">
                    <p><strong>Código:</strong> {{ $item->codigo }}</p>
                    <p><strong>Categoría:</strong> {{ $item->categoria }}</p>
                    <p><strong>Cantidad disponible:</strong> {{ $item->cantidad }}</p>
                    <p><strong>Umbral mínimo:</strong> {{ $item->umbral_minimo }}</p>
                    <p><strong>Ubicación:</strong> {{ $item->ubicacion ?? 'N/A' }}</p>
                    <p><strong>Proveedor:</strong> {{ $item->proveedor ?? 'N/A' }}</p>
                    <p><strong>Fecha de vencimiento:</strong> {{ $item->fecha_vencimiento ?? 'No aplica' }}</p>
                </div>

                {{-- Botones para admins --}}
                @if(auth()->user()->hasRole('admin'))
                    <div class="flex gap-3 mb-6">
                        <a href="{{ route('items.edit', $item) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                            ✏️ Editar Ítem
                        </a>
                        <a href="{{ route('items.editStock', $item) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            🔄 Actualizar Stock
                        </a>
                    </div>
                @endif

                {{-- Botones de alternancia --}}
                <div class="flex space-x-3 mb-4">
                    <button @click="mostrar = 'transacciones'" 
                            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700"
                            :class="{'bg-indigo-800': mostrar === 'transacciones'}">
                        📦 Historial de Transacciones
                    </button>
                    <button @click="mostrar = 'reservas'" 
                            class="px-4 py-2 rounded bg-teal-600 text-white hover:bg-teal-700"
                            :class="{'bg-teal-800': mostrar === 'reservas'}">
                        📘 Historial de Reservas
                    </button>
                </div>

                {{-- Sección: Transacciones --}}
                <div x-show="mostrar === 'transacciones'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2">📦 Historial de Transacciones</h4>
                    @if($item->transacciones->isEmpty())
                        <p class="text-gray-500">No hay transacciones registradas aún.</p>
                    @else
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Fecha</th>
                                        <th class="px-4 py-2 text-left">Tipo</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                                    @foreach ($item->transacciones->sortByDesc('created_at') as $t)
                                        <tr>
                                            <td class="px-4 py-2">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-2 capitalize">{{ $t->tipo }}</td>
                                            <td class="px-4 py-2">{{ $t->cantidad }}</td>
                                            <td class="px-4 py-2">{{ $t->descripcion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- Sección: Reservas --}}
                <div x-show="mostrar === 'reservas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2">📘 Historial de Reservas</h4>
                    @if ($item->reservas->isEmpty())
                        <p class="text-gray-500">Este ítem no ha sido reservado aún.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Usuario</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Fecha de Reserva</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                                    @foreach ($item->reservas->sortByDesc('created_at') as $reserva)
                                        <tr>
                                            <td class="px-4 py-2">{{ $reserva->user->name ?? 'Usuario desconocido' }}</td>
                                            <td class="px-4 py-2">{{ $reserva->cantidad ?? 1 }}</td>
                                            <td class="px-4 py-2">{{ $reserva->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-2">
                                                @switch($reserva->estado)
                                                    @case('pendiente') <span class="text-yellow-400">Pendiente</span> @break
                                                    @case('aprobada')  <span class="text-green-500">Aprobada</span> @break
                                                    @case('rechazada') <span class="text-red-500">Rechazada</span> @break
                                                    @default <span class="text-gray-400">{{ $reserva->estado }}</span>
                                                @endswitch
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
    </div>
</x-app-layout>
