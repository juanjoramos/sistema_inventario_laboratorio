<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Bienvenido {{ auth()->user()->email }} 👨‍🎓
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2 text-white">Bienvenido Estudiante 🎓</h1>
                <p class="text-gray-300">
                    Aquí podrás consultar tus reservas, devolver los recursos prestados y hacer seguimiento a tus actividades académicas.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-lg shadow flex items-center justify-between">
                    <p class="text-sm text-gray-600">Reservas activas</p>
                    <p class="text-2xl font-bold text-[#293a52]">{{ $reservas->whereIn('estado', ['pendiente', 'prestado'])->count() }}</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow flex items-center justify-between">
                    <p class="text-sm text-gray-600">Devueltas</p>
                    <p class="text-2xl font-bold text-[#293a52]">{{ $reservas->where('estado', 'devuelto')->count() }}</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow flex items-center justify-between">
                    <p class="text-sm text-gray-600">Canceladas</p>
                    <p class="text-2xl font-bold text-[#293a52]">{{ $reservas->where('estado', 'cancelado')->count() }}</p>
                </div>
            </div>

            @php
                $alerta = $reservas->where('estado', 'prestado')
                            ->filter(fn($r) => \Carbon\Carbon::parse($r->fecha_devolucion_prevista)->isToday() || 
                                               \Carbon\Carbon::parse($r->fecha_devolucion_prevista)->isTomorrow());
            @endphp

            @if($alerta->count())
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow">
                    <p><strong>Atención:</strong> Tienes {{ $alerta->count() }} reserva(s) que deben devolverse hoy o mañana.</p>
                </div>
            @endif

            <form method="GET" action="{{ route('reservas.mis_reservas') }}" class="mb-4 flex flex-col sm:flex-row gap-4">
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar ítem..." class="rounded px-4 py-2 w-full sm:w-1/3">

                <select name="estado" class="rounded px-4 py-2 w-full sm:w-1/3">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" @selected(request('estado') === 'pendiente')>Pendiente</option>
                    <option value="prestado" @selected(request('estado') === 'prestado')>Prestado</option>
                    <option value="cancelado" @selected(request('estado') === 'cancelado')>Cancelado</option>
                    <option value="devuelto" @selected(request('estado') === 'devuelto')>Devuelto</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
                    Filtrar
                </button>

                <a href="{{ route('reservas.mis_reservas') }}" 
                class="bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-600 text-center">
                Limpiar filtros
                </a>
            </form>

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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Acción</th>
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
                                        @elseif($reserva->estado === 'prestado')
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Prestado</span>
                                        @elseif($reserva->estado === 'cancelado')
                                            <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Cancelado</span>
                                        @elseif($reserva->estado === 'devuelto')
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Devuelto</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Desconocido</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $reserva->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-100">
                                        {{ \Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100 text-center">
                                        @if($reserva->estado === 'pendiente')
                                            <form action="{{ route('reservas.cancelar', $reserva) }}" method="POST" onsubmit="return confirm('¿Deseas cancelar esta reserva?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                                    Cancelar
                                                </button>
                                            </form>
                                        @elseif($reserva->estado === 'devuelto')
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                Devuelto
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic">--</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-300">
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