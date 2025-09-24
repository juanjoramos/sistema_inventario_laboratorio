<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <x-slot name="header">
            <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
                </svg>
                <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                    Reservas pendientes 📋
                </h2>
            </div>
        </x-slot>

        <div class="mt-6">
            <div class="bg-white border border-gray-200 shadow-md rounded-xl w-full p-4">
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-blue-50 text-blue-800 text-left">
                                <th class="px-4 py-2 border-b">Usuario</th>
                                <th class="px-4 py-2 border-b">Ítem</th>
                                <th class="px-4 py-2 border-b">Cantidad</th>
                                <th class="px-4 py-2 border-b">Estado</th>
                                <th class="px-4 py-2 border-b text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservas as $reserva)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $reserva->user->name }}</td>
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $reserva->item->nombre }}</td>
                                    <td class="px-4 py-2 border-b text-gray-700">{{ $reserva->cantidad }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($reserva->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                            @elseif($reserva->estado === 'aprobada') bg-green-100 text-green-700
                                            @elseif($reserva->estado === 'entregado') bg-blue-100 text-blue-700
                                            @elseif($reserva->estado === 'devuelto') bg-purple-100 text-purple-700
                                            @elseif($reserva->estado === 'cancelado') bg-red-100 text-red-700
                                            @else bg-gray-100 text-gray-700
                                            @endif">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        @if ($reserva->estado === 'pendiente')
                                            <form action="{{ route('admin.reservas.aprobar', $reserva) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Aprobar
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.reservas.rechazar', $reserva) }}" method="POST" class="inline ml-2">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Rechazar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 italic">Sin acción</span>
                                        @endif
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
