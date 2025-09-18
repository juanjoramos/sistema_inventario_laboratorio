<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Ítems disponibles 🎓 (Estudiante)</h1>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-2 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto border-collapse border border-gray-300 w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-2 py-1">Nombre</th>
                <th class="border px-2 py-1">Cantidad</th>
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
                    <td class="border px-2 py-1 text-center">
                        <!-- Botón para abrir modal -->
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded open-modal-btn"
                            data-item-id="{{ $item->id }}"
                            data-item-nombre="{{ $item->nombre }}"
                        >
                            Reservar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div id="reservation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <h2 class="text-xl font-bold mb-4">Registrar Préstamo</h2>
            <form id="reservation-form" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label for="usuario" class="block font-semibold">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" readonly class="w-full border px-2 py-1 rounded bg-gray-100" />
                </div>
                <div class="mb-4">
                    <label for="fecha_prestamo" class="block font-semibold">Fecha de préstamo:</label>
                    <input type="text" id="fecha_prestamo" name="fecha_prestamo" readonly class="w-full border px-2 py-1 rounded bg-gray-100" />
                </div>
                <div class="mb-4">
                    <label for="fecha_devolucion_prevista" class="block font-semibold">Fecha de devolución prevista:</label>
                    <input type="date" id="fecha_devolucion_prevista" name="fecha_devolucion_prevista" required class="w-full border px-2 py-1 rounded" />
                </div>
                <div class="mb-4">
                    <label for="motivo" class="block font-semibold">Motivo:</label>
                    <textarea id="motivo" name="motivo" required class="w-full border px-2 py-1 rounded"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="close-modal" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Confirmar</button>
                </div>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('reservation-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const form = document.getElementById('reservation-form');
        const usuarioInput = document.getElementById('usuario');
        const fechaPrestamoInput = document.getElementById('fecha_prestamo');
        const fechaDevolucionInput = document.getElementById('fecha_devolucion_prevista');

        // Obtener usuario actual desde Blade
        const usuarioNombre = @json(auth()->user()->name);

        // Botones para abrir modal
        document.querySelectorAll('.open-modal-btn').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const itemNombre = this.getAttribute('data-item-nombre');

                // Mostrar modal
                modal.classList.remove('hidden');

                // Setear acción del form con el id del item
                form.action = `/items/${itemId}/reservar`;

                // Poner nombre usuario
                usuarioInput.value = usuarioNombre;

                // Fecha préstamo = hoy en formato yyyy-mm-dd
                const hoy = new Date().toISOString().split('T')[0];
                fechaPrestamoInput.value = hoy;

                // calcular mañana (hoy+1)
                let fecha = new Date(hoy);
                fecha.setDate(fecha.getDate() + 0);
                const manana = fecha.toISOString().split('T')[0];

                // calcular límite (hoy+3)
                let limiteFecha = new Date(hoy);
                limiteFecha.setDate(limiteFecha.getDate() + 2);
                const limite = limiteFecha.toISOString().split('T')[0];

                // configurar rango permitido
                fechaDevolucionInput.min = manana;   // desde mañana
                fechaDevolucionInput.max = limite;   // hasta hoy+3
                fechaDevolucionInput.value = manana; // por defecto mañana

                // Limpiar campo motivo
                form.motivo.value = '';
            });
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Opcional: cerrar modal al hacer click fuera del contenido
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>

</x-app-layout>
