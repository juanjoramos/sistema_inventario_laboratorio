<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Detalle de Ítem: {{ $item->nombre }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-6" x-data="{ mostrar: 'transacciones' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                
                <div class="mb-6 text-white">
                    <p><strong>Código:</strong> {{ $item->codigo }}</p>
                    <p><strong>Categoría:</strong> {{ $item->categoria }}</p>
                    <p><strong>Cantidad disponible:</strong> {{ $item->cantidad }}</p>
                    <p><strong>Umbral mínimo:</strong> {{ $item->umbral_minimo }}</p>
                    <p><strong>Ubicación:</strong> {{ $item->ubicacion ?? 'N/A' }}</p>
                    <p><strong>Proveedor:</strong> {{ $item->proveedor ?? 'N/A' }}</p>
                    <p><strong>Fecha de vencimiento:</strong> {{ $item->fecha_vencimiento ?? 'No aplica' }}</p>
                </div>

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
                        <button @click="mostrar = 'alertas'" 
                            class="px-4 py-2 rounded bg-teal-600 text-white hover:bg-teal-700"
                            :class="{'bg-teal-800': mostrar === 'alertas'}">
                        📘 Historial de Alertas
                    </button>
                </div>

                <div x-show="mostrar === 'transacciones'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">📦 Historial de Transacciones</h4>
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
<td class="px-4 py-2">
    @if($t->usuario)
        Prestado por {{ $t->usuario->email }}
    @else
        {{ $t->descripcion }}
    @endif
</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div x-show="mostrar === 'reservas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">📘 Historial de Reservas</h4>
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
                                        <th class="px-4 py-2 text-left">Fecha de Devolución</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                                    @foreach ($item->reservas->sortByDesc('created_at') as $reserva)
                                        <tr>
                                            <td class="px-4 py-2">{{ $reserva->user->email ?? 'Usuario desconocido' }}</td>
                                            <td class="px-4 py-2">{{ $reserva->cantidad ?? 1 }}</td>
                                            <td class="px-4 py-2">{{ $reserva->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-2">
                                                @if($reserva->fecha_devolucion_real)
                                                    {{ $reserva->fecha_devolucion_real->format('d/m/Y H:i') }}
                                                @else
                                                    <span class="text-gray-400">
                                                        {{ $reserva->estado === 'devuelto' ? 'Sin fecha registrada' : 'No devuelto' }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @switch($reserva->estado)
                                                    @case('pendiente') <span class="text-yellow-400">Pendiente</span> @break
                                                    @case('entregado')  <span class="text-blue-400">Entregado</span> @break
                                                    @case('devuelto')  <span class="text-green-500">Devuelto</span> @break
                                                    @case('cancelado') <span class="text-red-500">Cancelado</span> @break
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
                <div x-show="mostrar === 'alertas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">⚠️ Historial de Alertas</h4>
                    @if ($item->alertas->isEmpty())
                        <p class="text-gray-400">Este ítem no tiene alertas registradas.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-[#293a52] rounded-lg shadow">
                                <thead class="bg-[#293a52] text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Fecha</th>
                                        <th class="px-4 py-2 text-left">Ítem Afectado</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-white">
                                    @foreach ($item->alertas->sortByDesc('created_at') as $alerta)
                                        <tr>
                                            <td class="px-4 py-2">{{ $alerta->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-4 py-2">{{ $item->nombre }}</td>
                                            <td class="px-4 py-2">{{ $alerta->cantidad }}</td>
                                            <td class="px-4 py-2">
                                                @switch($alerta->estado)
                                                    @case('pendiente') 
                                                        <span class="px-2 py-1 bg-yellow-500 text-black rounded">Pendiente</span> 
                                                        @break
                                                    @case('atendida') 
                                                        <span class="px-2 py-1 bg-green-600 text-white rounded">Atendida</span> 
                                                        @break
                                                    @default 
                                                        <span class="px-2 py-1 bg-gray-500 text-white rounded">{{ $alerta->estado }}</span>
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
