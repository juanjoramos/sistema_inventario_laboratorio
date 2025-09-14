<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Reservas pendientes 📋</h1>

    <table class="table-auto border-collapse border border-gray-300 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">Usuario</th>
                <th class="border px-2 py-1">Ítem</th>
                <th class="border px-2 py-1">Cantidad</th>
                <th class="border px-2 py-1">Estado</th>
                <th class="border px-2 py-1">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                <tr>
                    <td class="border px-2 py-1">{{ $reserva->user->name }}</td>
                    <td class="border px-2 py-1">{{ $reserva->item->nombre }}</td>
                    <td class="border px-2 py-1">{{ $reserva->cantidad }}</td>
                    <td class="border px-2 py-1">{{ ucfirst($reserva->estado) }}</td>
                    <td class="border px-2 py-1">
                        @if ($reserva->estado === 'pendiente')
                            <form action="{{ route('admin.reservas.aprobar', $reserva) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Aprobar</button>
                            </form>

                            <form action="{{ route('admin.reservas.rechazar', $reserva) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Rechazar</button>
                            </form>
                        @else
                            <span class="text-gray-500">Sin acción</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
