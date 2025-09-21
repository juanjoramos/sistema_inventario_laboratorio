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
            Ítems disponibles para Docentes 🧑‍🏫
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">

                
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

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Nombre</th>
                                <th class="border px-4 py-2 text-left">Cantidad disponible</th>
                                <th class="border px-4 py-2 text-left">Ubicación</th>
                                <th class="border px-4 py-2 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                    <td class="border px-4 py-2"><?php echo e($item->nombre); ?></td>
                                    <td class="border px-4 py-2"><?php echo e($item->cantidad); ?></td>
                                    <td class="border px-4 py-2"><?php echo e($item->ubicacion); ?></td>
                                    <td class="border px-4 py-2 text-center">
                                        <form action="<?php echo e(route('reservas.profesor_store', $item->id)); ?>" method="POST" class="inline-flex items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="number" 
                                                   name="cantidad" 
                                                   min="1" 
                                                   max="<?php echo e($item->cantidad); ?>" 
                                                   value="1" 
                                                   class="w-20 border rounded px-2 py-1 text-center">
                                            <button type="submit" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                                Reservar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">
                                        No hay ítems disponibles en este momento.
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
<?php endif; ?>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/docente_index.blade.php ENDPATH**/ ?>