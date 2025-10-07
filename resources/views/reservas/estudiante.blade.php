<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Ítems disponibles 🎓 (Estudiante)
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($errors->any())
                <div id="modal-errors" class="p-3 bg-red-600 text-white rounded shadow">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="p-3 bg-green-600 text-white rounded shadow">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-3 bg-red-600 text-white rounded shadow">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-white">📦 Inventario</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead>
                            <tr class="bg-[#1f2a3a]">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Categoria</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Ubicación</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach ($items as $item)
                                <tr class="hover:bg-[#36455e] transition">
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $item->nombre }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-100">
                                        @php
                                            $colores = [
                                                'Equipos' => 'bg-indigo-500',
                                                'Reactivos' => 'bg-green-500',
                                                'Materiales' => 'bg-yellow-500',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded text-white text-xs font-semibold {{ $colores[$item->categoria] ?? 'bg-gray-500' }}">
                                            {{ ucfirst($item->categoria) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $item->cantidad }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-100">{{ $item->ubicacion }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        @if ($item->cantidad > 0)
                                            <button
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow open-modal-btn"
                                                data-item-id="{{ $item->id }}"
                                                data-item-stock="{{ $item->cantidad }}"
                                            >
                                                Reservar
                                            </button>
                                        @else
                                            <button
                                                class="bg-gray-500 text-white px-3 py-1 rounded cursor-not-allowed"
                                                disabled
                                            >
                                                Sin stock
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div id="reservation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 relative animate-fadeIn">
                    <div class="flex items-center gap-3 border-b pb-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Registrar Préstamo</h2>
                    </div>

                    <form id="reservation-form" method="POST" action="" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="usuario" class="block text-sm font-semibold text-gray-700">👤 Usuario</label>
                            <input type="text" id="usuario" name="usuario" readonly 
                                class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label for="fecha_prestamo" class="block text-sm font-semibold text-gray-700">📅 Fecha de préstamo</label>
                            <input type="text" id="fecha_prestamo" name="fecha_prestamo" readonly 
                                class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label for="fecha_devolucion_prevista" class="block text-sm font-semibold text-gray-700">📆 Fecha de devolución prevista</label>
                            <input type="date" id="fecha_devolucion_prevista" name="fecha_devolucion_prevista" required 
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label for="motivo" class="block text-sm font-semibold text-gray-700">📝 Motivo</label>
                            <textarea id="motivo" name="motivo" rows="3" required 
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        </div>

                        <div class="flex justify-end gap-3 pt-3 border-t">
                            <button type="button" id="close-modal" 
                                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium transition">
                                Cancelar
                            </button>
                            <button type="submit" 
                                    class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md transition">
                                Confirmar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

            const usuarioNombre = @json(auth()->user()->name);

            function formatearFecha(date) {
                return date.toISOString().split("T")[0];
            }

            document.querySelectorAll('.open-modal-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-item-id');

                    modal.classList.remove('hidden');
                    form.action = `/items/${itemId}/reservar`;
                    usuarioInput.value = usuarioNombre;

                    const hoy = new Date();
                    const hoyStr = formatearFecha(hoy);
                    fechaPrestamoInput.value = hoyStr;

                    const maxFecha = new Date(hoy);
                    maxFecha.setDate(maxFecha.getDate() + 3);
                    const maxStr = formatearFecha(maxFecha);

                    fechaDevolucionInput.min = hoyStr;
                    fechaDevolucionInput.max = maxStr;
                    fechaDevolucionInput.value = hoyStr;

                    form.motivo.value = '';
                });
            });

            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
