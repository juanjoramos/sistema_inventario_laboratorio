<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h1 class="text-2xl font-bold mb-4">Ítems disponibles 🧑‍🏫 (Docente)</h1>


<?php if($errors->any()): ?>
    <div id="modal-errors" class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            ❌ <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

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
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="border px-2 py-1"><?php echo e($item->nombre); ?></td>
                    <td class="border px-2 py-1"><?php echo e($item->cantidad); ?></td>
                    <td class="border px-2 py-1"><?php echo e($item->ubicacion); ?></td>
                    <td class="border px-2 py-1 text-center">
                        <!-- Botón para abrir modal -->
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded open-modal-btn"
                            data-item-id="<?php echo e($item->id); ?>"
                            data-item-stock="<?php echo e($item->cantidad); ?>"
                        >
                            Reservar
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="reservation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <h2 class="text-xl font-bold mb-4">Registrar Reserva (Docente)</h2>

            
            <?php if($errors->any()): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <?php if(session('success')): ?>
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form id="reservation-form" method="POST" action="">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="usuario" class="block font-semibold">Usuario:</label>
                    <input type="text" id="usuario" readonly
                        class="w-full border px-2 py-1 rounded bg-gray-100"
                        value="<?php echo e(auth()->user()->name); ?>" />
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
            const errorsBlock = document.getElementById('modal-errors');

            // Fecha préstamo = hoy
            const hoy = new Date().toISOString().split('T')[0];
            fechaPrestamoInput.value = hoy;

            // Botones abrir modal
            document.querySelectorAll('.open-modal-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-item-id');
                    const stock = this.getAttribute('data-item-stock');

                    modal.classList.remove('hidden');
                    form.action = "<?php echo e(route('reservas.profesor_store', ':id')); ?>".replace(':id', itemId);
                    cantidadInput.value = 1;
                    cantidadInput.max = stock;
                    form.fecha_devolucion_prevista.value = '';
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
            <?php if($errors->any()): ?>
                modal.classList.remove('hidden');
            <?php endif; ?>
        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/reservas/docente.blade.php ENDPATH**/ ?>