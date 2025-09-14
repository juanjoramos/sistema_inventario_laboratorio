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
            Inventario de Ítems
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <a href="<?php echo e(route('items.create')); ?>" 
                   class="inline-block mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    + Nuevo ítem
                </a>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Código</th>
                                <th class="px-4 py-2 text-left">Categoría</th>
                                <th class="px-4 py-2 text-left">Cantidad</th>
                                <th class="px-4 py-2 text-left">Ubicación</th>
                                <th class="px-4 py-2 text-left">Proveedor</th>
                                <th class="px-4 py-2 text-left">Fecha vencimiento</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr <?php if($item->cantidad <= $item->umbral_minimo): ?> class="bg-red-100 dark:bg-red-700" <?php endif; ?>>
                                    <td class="px-4 py-2"><?php echo e($item->nombre); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->codigo); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->categoria); ?></td>
                                    <td class="px-4 py-2">
                                        <?php echo e($item->cantidad); ?>

                                        <?php if($item->cantidad <= $item->umbral_minimo && auth()->user()->hasRole('admin')): ?>
                                            <span class="ml-2 px-2 py-1 bg-red-600 text-white rounded">¡Reabastecer!</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2"><?php echo e($item->ubicacion); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->proveedor); ?></td>
                                    <td class="px-4 py-2"><?php echo e($item->fecha_vencimiento); ?></td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <!-- Editar -->
                                        <a href="<?php echo e(route('items.edit', $item->id)); ?>" 
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                                            Editar
                                        </a>

                                        <!-- Ver -->
                                        <a href="<?php echo e(route('items.show', $item->id)); ?>" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                                            Ver
                                        </a>

                                        <!-- Actualizar Stock -->
                                        <a href="<?php echo e(route('items.editStock', $item->id)); ?>" 
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded">
                                            Stock
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="<?php echo e(route('items.destroy', $item->id)); ?>" method="POST" 
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este ítem?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                                                Eliminar
                                            </button>
                                        </form>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/index.blade.php ENDPATH**/ ?>