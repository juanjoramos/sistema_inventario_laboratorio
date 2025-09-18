<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Ítems disponibles 🧑‍🏫 (Docente)</h1>

    @if ($errors->any())
        <div id="modal-errors" class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            ❌ {{ session('error') }}
        </div>
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
                    <td class="border px-2 py-1 text-center">
                        <!-- Botón para abrir modal -->
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded open-modal-btn"
                            data-item-id="{{ $item->id }}"
                            data-item-stock="{{ $item->cantidad }}"
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
            <h2 class="text-xl font-bold mb-4">Registrar Reserva (Docente)</h2>

            {{-- ✅ Mostrar errores dentro del modal --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ Mensajes de sesión --}}
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

            <form id="reservation-form" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label for="usuario" class="block font-semibold">Usuario:</label>
                    <input type="text" id="usuario" readonly
                        class="w-full border px-2 py-1 rounded bg-gray-100"
                        value="{{ auth()->user()->name }}" />
                </div>
                <div class="mb-4">
                    <label for="cantidad" class="block font-semibold">Cantidad a reservar:</label>
                    <input type="number" id="cantidad" name="cantidad" min="1"
                        class="w-full border px-2 py-1 rounded" required />
                </div>
                <div class="mb-4">
                    <label for="fecha_prestamo" class="block font-semibold">Fecha de préstamo:</label>
                    <input type="text" id="fecha_prestamo" readonly
                        class="w-full border px-2 py-1 rounded bg-gray-100" />
                </div>
                <div class="mb-4">
                    <label for="fecha_devolucion_prevista" class="block font-semibold">Fecha de devolución prevista:</label>
                    <input type="date" id="fecha_devolucion_prevista" name="fecha_devolucion_prevista"
                        class="w-full border px-2 py-1 rounded" required />
                </div>
                <div class="mb-4">
                    <label for="motivo" class="block font-semibold">Motivo:</label>
                    <textarea id="motivo" name="motivo" required class="w-full border px-2 py-1 rounded"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="close-modal"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
                    <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Confirmar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('reservation-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const form = document.getElementById('reservation-form');
            const cantidadInput = document.getElementById('cantidad');
            const fechaPrestamoInput = document.getElementById('fecha_prestamo');
            const fechaDevolucionInput = document.getElementById('fecha_devolucion_prevista');
            const errorsBlock = document.getElementById('modal-errors');

            //Fecha préstamo = hoy
            const hoy = new Date().toISOString().split('T')[0];
            fechaPrestamoInput.value = hoy;

            //Calcular límites para la devolución
            let fechaHoy = new Date(hoy);

            let fechaManana = new Date(fechaHoy);
            fechaManana.setDate(fechaHoy.getDate() + 0);
            const manana = fechaManana.toISOString().split('T')[0];

            let fechaMax = new Date(fechaHoy);
            fechaMax.setDate(fechaHoy.getDate() + 5);
            const limite = fechaMax.toISOString().split('T')[0];

            // Configurar rango permitido en el input de fecha devolución
            fechaDevolucionInput.min = manana;
            fechaDevolucionInput.max = limite;
            fechaDevolucionInput.value = manana;

            // Botones abrir modal
            document.querySelectorAll('.open-modal-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-item-id');
                    const stock = this.getAttribute('data-item-stock');

                    modal.classList.remove('hidden');
                    form.action = "{{ route('reservas.profesor_store', ':id') }}".replace(':id', itemId);
                    cantidadInput.value = 1;
                    cantidadInput.max = stock;
                    form.fecha_devolucion_prevista.value = manana; // siempre arranca en mañana
                    form.motivo.value = '';
                });
            });

            // Función cerrar modal y limpiar errores
            function cerrarModal() {
                modal.classList.add('hidden');
                if (errorsBlock) {
                    errorsBlock.remove(); // ✅ limpia los errores al cerrar
                }
            }

            // Botón cerrar modal
            closeModalBtn.addEventListener('click', cerrarModal);

            // Cerrar modal si clic afuera
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    cerrarModal();
                }
            });

            // ✅ Reabrir modal automáticamente si hubo errores
            @if ($errors->any())
                modal.classList.remove('hidden');
            @endif
        });
    </script>
</x-app-layout>