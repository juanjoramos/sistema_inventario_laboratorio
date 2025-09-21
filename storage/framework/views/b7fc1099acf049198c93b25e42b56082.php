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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bienvenido Estudiante 👨‍🎓
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Aquí va el contenido del dashboard de estudiante 🚀
                </div>
            </div>

            
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">📋 Mis Reservas</h3>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Ítem</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Fecha Reserva</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Devolución Prevista</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100"><?php echo e($loop->iteration); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100"><?php echo e($reserva->item->nombre); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100"><?php echo e($reserva->cantidad); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <?php if($reserva->estado === 'pendiente'): ?>
                                        <span class="px-2 py-1 text-yellow-700 bg-yellow-100 rounded-full">Pendiente</span>
                                    <?php elseif($reserva->estado === 'entregado'): ?>
                                        <span class="px-2 py-1 text-green-700 bg-green-100 rounded-full">Entregado</span>
                                    <?php elseif($reserva->estado === 'cancelado'): ?>
                                        <span class="px-2 py-1 text-red-700 bg-red-100 rounded-full">Cancelado</span>
                                    <?php elseif($reserva->estado === 'devuelto'): ?>
                                        <span class="px-2 py-1 text-blue-700 bg-blue-100 rounded-full">Devuelto</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-gray-700 bg-gray-100 rounded-full">Desconocido</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100"><?php echo e($reserva->created_at->format('d/m/Y H:i')); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100"><?php echo e(\Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y')); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    <?php if($reserva->estado === 'entregado'): ?>
                                        <form action="<?php echo e(route('reservas.devolver', $reserva)); ?>" method="POST" onsubmit="return confirm('¿Deseas devolver este ítem?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                Devolver
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No tienes reservas aún.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/estudiante/dashboard.blade.php ENDPATH**/ ?>