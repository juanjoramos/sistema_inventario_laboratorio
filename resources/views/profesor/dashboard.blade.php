<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Bienvenido {{ auth()->user()->name }} 👨‍🏫
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2 text-white">Bienvenido Profesor 👨‍🏫</h1>
                <p class="text-gray-300">
                    Gestiona tus clases, acompaña a tus estudiantes y administra los recursos asignados de manera sencilla y eficiente.
                </p>
            </div>

            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-white">📋 Mis Reservas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead>
                            <tr class="bg-[#1f2a3a]">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Ítem</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Fecha Reserva</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Devolución Prevista</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($reservas as $reserva)
                                <tr class="hover:bg-[#36455e] transition">
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $reserva->item->nombre }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $reserva->cantidad }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($reserva->estado === 'pendiente')
                                            <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pendiente</span>
                                        @elseif($reserva->estado === 'entregado')
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Entregado</span>
                                        @elseif($reserva->estado === 'cancelado')
                                            <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Cancelado</span>
                                        @elseif($reserva->estado === 'devuelto')
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Devuelto</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Desconocido</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100">
                                        {{ $reserva->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100">
                                        {{ \Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-300">
                                        No tienes reservas aún.
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