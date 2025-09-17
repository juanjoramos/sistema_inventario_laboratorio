<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bienvenido Estudiante 👨‍🎓
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Aquí va el contenido del dashboard de estudiante 🚀
                </div>
            </div>

            {{-- 👇 Tabla de reservas del estudiante --}}
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">📋 Mis Reservas</h3>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Ítem</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Fecha Reserva</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Devolución Prevista</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($reservas as $reserva)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $reserva->item->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $reserva->cantidad }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($reserva->estado === 'pendiente')
                                        <span class="px-2 py-1 text-yellow-700 bg-yellow-100 rounded-full">Pendiente</span>
                                    @elseif($reserva->estado === 'entregado')
                                        <span class="px-2 py-1 text-green-700 bg-green-100 rounded-full">Entregado</span>
                                    @elseif($reserva->estado === 'cancelado')
                                        <span class="px-2 py-1 text-red-700 bg-red-100 rounded-full">Cancelado</span>
                                    @elseif($reserva->estado === 'devuelto')
                                        <span class="px-2 py-1 text-blue-700 bg-blue-100 rounded-full">Devuelto</span>
                                    @else
                                        <span class="px-2 py-1 text-gray-700 bg-gray-100 rounded-full">Desconocido</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $reserva->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    @if($reserva->estado === 'entregado')
                                        <form action="{{ route('reservas.devolver', $reserva) }}" method="POST" onsubmit="return confirm('¿Deseas devolver este ítem?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                Devolver
                                            </button>
                                        </form>
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No tienes reservas aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Botón para ir a hacer reservas --}}
            <div class="mt-6">
                <a href="{{ route('reservas.estudiante') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Ver ítems disponibles / Hacer nueva reserva
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
