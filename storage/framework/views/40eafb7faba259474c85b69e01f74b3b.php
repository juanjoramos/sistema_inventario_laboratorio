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
     <?php $__env->slot('header', null, []); ?> 
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Bienvenido <?php echo e(auth()->user()->name); ?> 🛠️
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Total Ítems</div>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-300"><?php echo e($totalItems); ?></div>
                    </div>
                    <div class="text-blue-500 text-3xl">📦</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Ítems Bajo Stock</div>
                        <div class="text-3xl font-bold text-red-500 dark:text-red-300"><?php echo e($lowStockCount); ?></div>
                    </div>
                    <div class="text-red-500 text-3xl">⚠️</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Reservas Pendientes</div>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-300"><?php echo e($reservasPendientes); ?></div>
                    </div>
                    <div class="text-green-500 text-3xl">📋</div>
                </div>
            </div>

            <div class="rounded-lg shadow p-6 mb-10" style="background-color:#293a52">
                <div class="mb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">📉 Ítems con Bajo Stock</h3>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('items.index')); ?>" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow text-sm">
                            Ver Inventario Completo
                        </a>
                        <a href="<?php echo e(route('items.create')); ?>" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow text-sm">
                            ➕ Agregar Ítem
                        </a>
                    </div>
                </div>

                <?php if($items->isEmpty()): ?>
                    <div class="p-4 bg-blue-50 text-blue-700 rounded-md text-sm">
                        No hay ítems con bajo stock actualmente.
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left border rounded-md overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">Cantidad</th>
                                    <th class="px-4 py-2">Umbral Mínimo</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-white">
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?php echo e($item->nombre); ?></td>
                                        <td class="px-4 py-2"><?php echo e($item->cantidad); ?></td>
                                        <td class="px-4 py-2"><?php echo e($item->umbral_minimo); ?></td>
                                        <td class="px-4 py-2">
                                            <a href="<?php echo e(route('items.editStock', $item)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                ✏️ Actualizar Stock
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div class="rounded-lg shadow p-6" style="background-color:#293a52">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">📋 Últimas Reservas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border rounded-md overflow-hidden">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-2">Usuario</th>
                                <th class="px-4 py-2">Ítem</th>
                                <th class="px-4 py-2">Cantidad</th>
                                <th class="px-4 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-white">
                            <?php $__empty_1 = true; $__currentLoopData = $ultimasReservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2"><?php echo e($reserva->user->email); ?></td>
                                    <td class="px-4 py-2"><?php echo e($reserva->item->nombre); ?></td>
                                    <td class="px-4 py-2"><?php echo e($reserva->cantidad); ?></td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded 
                                            <?php if($reserva->estado == 'pendiente'): ?> bg-yellow-100 text-yellow-800 
                                            <?php elseif($reserva->estado == 'prestado'): ?> bg-blue-100 text-blue-800 
                                            <?php elseif($reserva->estado == 'devuelto'): ?> bg-purple-100 text-purple-800 
                                            <?php else: ?> bg-gray-200 text-gray-800 
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($reserva->estado)); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-gray-500 italic text-center">No hay reservas recientes.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>