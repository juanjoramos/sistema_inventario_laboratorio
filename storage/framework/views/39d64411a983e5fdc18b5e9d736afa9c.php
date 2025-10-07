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
    <div class="max-w-6xl mx-auto" x-data="{ openModalId: null }">
         <?php $__env->slot('header', null, []); ?> 
            <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
                </svg>
                <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                    Reservas pendientes 📋
                </h2>
            </div>
         <?php $__env->endSlot(); ?>

        <div class="mt-6">
            <div class="border border-gray-200 shadow-md rounded-xl w-full p-4" style="background-color:#293a52">
                <div class="overflow-x-auto">
                    <form method="GET" action="<?php echo e(route('admin.reservas.index')); ?>" class="mb-4 flex flex-wrap items-center gap-3">
                        <input type="text" name="email" placeholder="Buscar por correo..."
                            value="<?php echo e(request('email')); ?>"
                            class="border border-gray-300 rounded px-4 py-2 w-full md:w-64 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            🔍 Buscar
                        </button>
                        <a href="<?php echo e(route('admin.reservas.index')); ?>"
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
                            <?php $__empty_1 = true; $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-[#1f2b3a] transition text-white">
                                    <td class="px-4 py-2 border-b"><?php echo e($reserva->user->email); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo e($reserva->item->nombre); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo e($reserva->cantidad); ?></td>
                                    <td class="px-4 py-2 border-b">
                                        <span class="px-2 py-1 rounded text-sm
                                            <?php if($reserva->estado === 'pendiente'): ?> bg-yellow-100 text-yellow-700
                                            <?php elseif($reserva->estado === 'prestado'): ?> bg-blue-100 text-blue-700
                                            <?php elseif($reserva->estado === 'devuelto'): ?> bg-purple-100 text-purple-700
                                            <?php elseif($reserva->estado === 'cancelado'): ?> bg-red-100 text-red-700
                                            <?php else: ?> bg-gray-100 text-gray-700
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($reserva->estado)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <?php if($reserva->estado === 'cancelado'): ?>
                                            <span class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded">Cancelado</span>
                                        <?php elseif($reserva->estado === 'devuelto'): ?>
                                            <span class="px-2 py-1 text-sm bg-purple-100 text-purple-700 rounded">Devuelto</span>
                                        <?php elseif(Auth::user()->roles->contains('name', 'admin')): ?>
                                            <?php if($reserva->estado === 'pendiente'): ?>
                                                <form action="<?php echo e(route('admin.reservas.aprobar', $reserva)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition">Aprobar</button>
                                                </form>
                                                <form action="<?php echo e(route('admin.reservas.rechazar', $reserva)); ?>" method="POST" class="inline ml-2">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">Rechazar</button>
                                                </form>
                                            <?php elseif($reserva->estado === 'prestado'): ?>
                                                <!-- Botón para mostrar modal -->
                                                <button @click="openModalId = <?php echo e($reserva->id); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Devolver
                                                </button>

                                                <!-- Modal -->
                                                <div x-show="openModalId === <?php echo e($reserva->id); ?>" x-cloak
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                                                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">Confirmar devolución</h2>
                                                        <p class="text-gray-600 dark:text-gray-300">
                                                            ¿Deseas marcar como <strong>devuelto</strong> el ítem <strong><?php echo e($reserva->item->nombre); ?></strong> reservado por <strong><?php echo e($reserva->user->email); ?></strong>?
                                                        </p>
                                                        <div class="mt-4 flex justify-end gap-3">
                                                            <button @click="openModalId = null"
                                                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                                                Cancelar
                                                            </button>
                                                            <form action="<?php echo e(route('admin.reservas.devolver', $reserva)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                                <button type="submit"
                                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                                                    Confirmar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fin Modal -->
                                            <?php else: ?>
                                                <span class="text-gray-400 italic">Sin acción</span>
                                            <?php endif; ?>
                                        <?php elseif($reserva->user_id === Auth::id() && $reserva->estado === 'pendiente'): ?>
                                            <form action="<?php echo e(route('reservas.cancelar', $reserva)); ?>" method="POST" onsubmit="return confirm('¿Deseas cancelar esta reserva?');">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">Cancelar</button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">Sin acción</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-300">No se encontraron reservas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="mt-4 text-white">
                        <?php echo e($reservas->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/reservas/index.blade.php ENDPATH**/ ?>