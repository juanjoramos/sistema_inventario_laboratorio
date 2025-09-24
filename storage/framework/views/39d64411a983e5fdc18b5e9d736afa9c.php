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
    <div class="max-w-6xl mx-auto">
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
            <div class="bg-white border border-gray-200 shadow-md rounded-xl w-full p-4">
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-blue-50 text-blue-800 text-left">
                                <th class="px-4 py-2 border-b">Usuario</th>
                                <th class="px-4 py-2 border-b">Ítem</th>
                                <th class="px-4 py-2 border-b">Cantidad</th>
                                <th class="px-4 py-2 border-b">Estado</th>
                                <th class="px-4 py-2 border-b text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-2 border-b text-gray-700"><?php echo e($reserva->user->name); ?></td>
                                    <td class="px-4 py-2 border-b text-gray-700"><?php echo e($reserva->item->nombre); ?></td>
                                    <td class="px-4 py-2 border-b text-gray-700"><?php echo e($reserva->cantidad); ?></td>
                                    <td class="px-4 py-2 border-b">
                                        <span class="px-2 py-1 rounded text-sm
                                            <?php if($reserva->estado === 'pendiente'): ?> bg-yellow-100 text-yellow-700
                                            <?php elseif($reserva->estado === 'aprobada'): ?> bg-green-100 text-green-700
                                            <?php elseif($reserva->estado === 'entregado'): ?> bg-blue-100 text-blue-700
                                            <?php elseif($reserva->estado === 'devuelto'): ?> bg-purple-100 text-purple-700
                                            <?php elseif($reserva->estado === 'cancelado'): ?> bg-red-100 text-red-700
                                            <?php else: ?> bg-gray-100 text-gray-700
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($reserva->estado)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <?php if($reserva->estado === 'pendiente'): ?>
                                            <form action="<?php echo e(route('admin.reservas.aprobar', $reserva)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Aprobar
                                                </button>
                                            </form>

                                            <form action="<?php echo e(route('admin.reservas.rechazar', $reserva)); ?>" method="POST" class="inline ml-2">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Rechazar
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">Sin acción</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/reservas/index.blade.php ENDPATH**/ ?>