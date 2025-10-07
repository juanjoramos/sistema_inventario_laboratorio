<x-app-layout>
    <div class="max-w-6xl mx-auto" x-data="{ openModalId: null }">
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
            <div class="border border-gray-200 shadow-md rounded-xl w-full p-4" style="background-color:#293a52">
                <div class="overflow-x-auto">
                    <form method="GET" action="{{ route('admin.reservas.index') }}" class="mb-4 flex flex-wrap items-center gap-3">
                        <input type="text" name="email" placeholder="Buscar por correo..."
                            value="{{ request('email') }}"
                            class="border border-gray-300 rounded px-4 py-2 w-full md:w-64 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            🔍 Buscar
                        </button>
                        <a href="{{ route('admin.reservas.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
                            Limpiar
                        </a>
                    </form>

                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-blue-200 dark:bg-blue-800 text-gray-900 dark:text-white text-left">
                            <tr>
                                <th class="px-4 py-2 border-b">Correo</th>
                                <th class="px-4 py-2 border-b">Ítem</th>
                                <th class="px-4 py-2 border-b">Cantidad</th>
                                <th class="px-4 py-2 border-b">Estado</th>
                                <th class="px-4 py-2 border-b text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservas as $reserva)
                                <tr class="hover:bg-[#1f2b3a] transition text-white">
                                    <td class="px-4 py-2 border-b">{{ $reserva->user->email }}</td>
                                    <td class="px-4 py-2 border-b">{{ $reserva->item->nombre }}</td>
                                    <td class="px-4 py-2 border-b">{{ $reserva->cantidad }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($reserva->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                            @elseif($reserva->estado === 'prestado') bg-blue-100 text-blue-700
                                            @elseif($reserva->estado === 'devuelto') bg-purple-100 text-purple-700
                                            @elseif($reserva->estado === 'cancelado') bg-red-100 text-red-700
                                            @else bg-gray-100 text-gray-700
                                            @endif">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        @if($reserva->estado === 'cancelado')
                                            <span class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded">Cancelado</span>
                                        @elseif($reserva->estado === 'devuelto')
                                            <span class="px-2 py-1 text-sm bg-purple-100 text-purple-700 rounded">Devuelto</span>
                                        @elseif(Auth::user()->roles->contains('name', 'admin'))
                                            @if($reserva->estado === 'pendiente')
                                                <form action="{{ route('admin.reservas.aprobar', $reserva) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition">Aprobar</button>
                                                </form>
                                                <form action="{{ route('admin.reservas.rechazar', $reserva) }}" method="POST" class="inline ml-2">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">Rechazar</button>
                                                </form>
                                            @elseif($reserva->estado === 'prestado')
                                                <!-- Botón para mostrar modal -->
                                                <button @click="openModalId = {{ $reserva->id }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Devolver
                                                </button>

                                                <!-- Modal -->
                                                <div x-show="openModalId === {{ $reserva->id }}" x-cloak
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                                                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">Confirmar devolución</h2>
                                                        <p class="text-gray-600 dark:text-gray-300">
                                                            ¿Deseas marcar como <strong>devuelto</strong> el ítem <strong>{{ $reserva->item->nombre }}</strong> reservado por <strong>{{ $reserva->user->email }}</strong>?
                                                        </p>
                                                        <div class="mt-4 flex justify-end gap-3">
                                                            <button @click="openModalId = null"
                                                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                                                Cancelar
                                                            </button>
                                                            <form action="{{ route('admin.reservas.devolver', $reserva) }}" method="POST">
                                                                @csrf @method('PATCH')
                                                                <button type="submit"
                                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                                                    Confirmar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fin Modal -->
                                            @else
                                                <span class="text-gray-400 italic">Sin acción</span>
                                            @endif
                                        @elseif($reserva->user_id === Auth::id() && $reserva->estado === 'pendiente')
                                            <form action="{{ route('reservas.cancelar', $reserva) }}" method="POST" onsubmit="return confirm('¿Deseas cancelar esta reserva?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">Cancelar</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 italic">Sin acción</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-300">No se encontraron reservas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4 text-white">
                        {{ $reservas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>