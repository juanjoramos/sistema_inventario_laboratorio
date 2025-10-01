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
                Bienvenido <?php echo e(auth()->user()->name); ?> 👨‍🏫
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2 text-white">Bienvenido Profesor 👨‍🏫</h1>
                <p class="text-gray-300">
                    Gestiona tus clases, acompaña a tus estudiantes y administra los recursos asignados de manera sencilla y eficiente.
                </p>
            </div>

            <!-- Mis Reservas -->
            <div class="bg-[#293a52] shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-white">📋 Mis Reservas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead>
                            <tr class="bg-[#1f2a3a]">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Ítem</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Fecha Reserva</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Devolución Prevista</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php $__empty_1 = true; $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-[#36455e] transition">
                                    <td class="px-6 py-4 text-sm text-gray-100"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-100"><?php echo e($reserva->item->nombre); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-100"><?php echo e($reserva->cantidad); ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <?php if($reserva->estado === 'pendiente'): ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pendiente</span>
                                        <?php elseif($reserva->estado === 'entregado'): ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Entregado</span>
                                        <?php elseif($reserva->estado === 'cancelado'): ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Cancelado</span>
                                        <?php elseif($reserva->estado === 'devuelto'): ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Devuelto</span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Desconocido</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-100"><?php echo e($reserva->created_at->format('d/m/Y H:i')); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-100"><?php echo e(\Carbon\Carbon::parse($reserva->fecha_devolucion_prevista)->format('d/m/Y')); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-100 text-center">
                                        <?php if($reserva->estado === 'pendiente'): ?>
                                            <form action="<?php echo e(route('reservas.cancelar', $reserva)); ?>" method="POST" onsubmit="return confirm('¿Deseas cancelar esta reserva?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-sm">
                                                    Cancelar
                                                </button>
                                            </form>
                                        <?php elseif($reserva->estado === 'devuelto'): ?>
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                Devuelto
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">--</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-300">
                                        No tienes reservas aún.
                                    </td>
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
<?php endif; ?><?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/profesor/dashboard.blade.php ENDPATH**/ ?>