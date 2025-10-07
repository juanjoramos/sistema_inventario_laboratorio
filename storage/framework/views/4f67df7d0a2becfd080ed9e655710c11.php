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
                Inventario de Ítems 📦
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6" x-data="{ openModalId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-md sm:rounded-lg p-6" style="background-color:#293a52">
                <div class="flex justify-between items-center mb-4">
                    <a href="<?php echo e(route('items.create')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        ➕ Nuevo ítem
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-blue-200 dark:bg-blue-800 text-gray-800 dark:text-white">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Código</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Cantidad</th>
                                <th class="px-4 py-3">Ubicación</th>
                                <th class="px-4 py-3">Proveedor</th>
                                <th class="px-4 py-3">Vencimiento</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr <?php if($item->cantidad <= $item->umbral_minimo): ?> class="bg-red-50 dark:bg-red-800/50" <?php endif; ?>>
                                    <td class="px-4 py-2"><?php echo e($item->nombre); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->codigo); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->categoria); ?></td>
                                    <td class="px-4 py-2">
                                        <?php echo e($item->cantidad); ?>

                                        <?php if($item->cantidad <= $item->umbral_minimo && auth()->user()->hasRole('admin')): ?>
                                            <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">
                                                ¡Reabastecer!
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2"><?php echo e($item->ubicacion); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->proveedor); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->fecha_vencimiento); ?></td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2 flex-wrap">
                                            <a href="<?php echo e(route('items.edit', $item->id)); ?>" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                Editar
                                            </a>

                                            <a href="<?php echo e(route('items.show', $item->id)); ?>" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                Detalles
                                            </a>

                                            <a href="<?php echo e(route('items.editStock', $item->id)); ?>" 
                                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                                                Stock
                                            </a>

                                            <button @click="openModalId = <?php echo e($item->id); ?>" type="button" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <div 
                                                x-show="openModalId === <?php echo e($item->id); ?>" 
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" 
                                                x-cloak>
                                                
                                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                                                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2 flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Confirmar eliminación
                                                    </h3>
                                                    <p class="text-gray-600 dark:text-gray-300">
                                                        ¿Estás seguro de que deseas eliminar <strong><?php echo e($item->nombre); ?></strong>? Esta acción no se puede deshacer.
                                                    </p>

                                                    <div class="mt-4 flex justify-end gap-3">
                                                        <button 
                                                            @click="openModalId = null"
                                                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                                                            Cancelar
                                                        </button>

                                                        <form action="<?php echo e(route('items.destroy', $item->id)); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit"
                                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fin del modal -->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center px-4 py-6 text-gray-500 dark:text-gray-400">
                                        No hay ítems en el inventario.
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/index.blade.php ENDPATH**/ ?>