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
            Dashboard Administrador 🛠️
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Bienvenido Administrador 🛠️</h1>

                <div class="mb-4 flex gap-3">
                    <a href="<?php echo e(route('items.index')); ?>" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                        📦 Ver Inventario Completo
                    </a>
                    <a href="<?php echo e(route('items.create')); ?>" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                        ➕ Agregar Ítem
                    </a>
                    <a href="<?php echo e(route('admin.reservas.index')); ?>" 
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow">
                    📋 Ver Reservas Pendientes
                    </a>
                    <a href="<?php echo e(route('users.index')); ?>" 
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
                        👥 Gestionar Usuarios
                    </a>
                </div>

                <?php if($items->isEmpty()): ?>
                    <div class="p-4 bg-blue-100 text-blue-700 rounded-md">
                        No hay ítems con bajo stock actualmente.
                    </div>
                <?php else: ?>
                    <!-- Resumen rápido -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nombre</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Cantidad</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Umbral mínimo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?php echo e($item->nombre); ?></td>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?php echo e($item->cantidad); ?></td>
                                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?php echo e($item->umbral_minimo); ?></td>
                                        <td class="px-4 py-2">
                                            <a href="<?php echo e(route('items.editStock', $item)); ?>" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">
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