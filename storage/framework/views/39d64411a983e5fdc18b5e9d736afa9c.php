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
    <h1 class="text-2xl font-bold mb-4">Reservas pendientes 📋</h1>

    <table class="table-auto border-collapse border border-gray-300 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">Usuario</th>
                <th class="border px-2 py-1">Ítem</th>
                <th class="border px-2 py-1">Cantidad</th>
                <th class="border px-2 py-1">Estado</th>
                <th class="border px-2 py-1">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="border px-2 py-1"><?php echo e($reserva->user->name); ?></td>
                    <td class="border px-2 py-1"><?php echo e($reserva->item->nombre); ?></td>
                    <td class="border px-2 py-1"><?php echo e($reserva->cantidad); ?></td>
                    <td class="border px-2 py-1"><?php echo e(ucfirst($reserva->estado)); ?></td>
                    <td class="border px-2 py-1">
                        <?php if($reserva->estado === 'pendiente'): ?>
                            <form action="<?php echo e(route('admin.reservas.aprobar', $reserva)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Aprobar</button>
                            </form>

                            <form action="<?php echo e(route('admin.reservas.rechazar', $reserva)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Rechazar</button>
                            </form>
                        <?php else: ?>
                            <span class="text-gray-500">Sin acción</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
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