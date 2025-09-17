<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ítems disponibles 🎓
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">

                {{-- Mensajes de éxito o error --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Nombre</th>
                                <th class="border px-4 py-2 text-left">Cantidad disponible</th>
                                <th class="border px-4 py-2 text-left">Ubicación</th>
                                <th class="border px-4 py-2 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                    <td class="border px-4 py-2">{{ $item->nombre }}</td>
                                    <td class="border px-4 py-2">{{ $item->cantidad }}</td>
                                    <td class="border px-4 py-2">{{ $item->ubicacion }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <form action="{{ route('reservas.store', $item->id) }}" method="POST" class="flex flex-col space-y-2">
                                            @csrf
                                            <input
                                                type="date"
                                                name="fecha_devolucion_prevista"
                                                required
                                                class="border px-2 py-1 rounded text-sm"
                                            >
                                            <textarea
                                                name="motivo"
                                                placeholder="Motivo del préstamo"
                                                required
                                                class="border px-2 py-1 rounded text-sm"
                                            ></textarea>
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                                Reservar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">
                                        No hay ítems disponibles en este momento.
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
