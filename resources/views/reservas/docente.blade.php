<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Ítems disponibles 🧑‍🏫 (Docente)</h1>

    {{-- ✅ Mostrar mensajes de error y éxito --}}
    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-2 rounded mb-3">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="table-auto border-collapse border border-gray-300 w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-2 py-1">Nombre</th>
                <th class="border px-2 py-1">Cantidad disponible</th>
                <th class="border px-2 py-1">Ubicación</th>
                <th class="border px-2 py-1">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="border px-2 py-1">{{ $item->nombre }}</td>
                    <td class="border px-2 py-1">{{ $item->cantidad }}</td>
                    <td class="border px-2 py-1">{{ $item->ubicacion }}</td>
                    <td class="border px-2 py-1">
                        <form action="{{ route('reservas.profesor_store', $item->id) }}" method="POST">
                            @csrf
                            <input type="number" name="cantidad" min="1" max="{{ $item->cantidad }}" value="1"
                                class="w-16 border rounded px-1 py-0.5">
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                Reservar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
