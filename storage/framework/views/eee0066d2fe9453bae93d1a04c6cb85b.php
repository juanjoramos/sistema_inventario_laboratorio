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
                Editar Ítem 📦
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <?php if($errors->any()): ?>
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg">
                <form action="<?php echo e(route('items.update', $item->id)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="nombre" value="<?php echo e(old('nombre', $item->nombre)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Código</label>
                        <input type="text" name="codigo" value="<?php echo e(old('codigo', $item->codigo)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Categoría</label>
                        <select name="categoria" class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Equipos" <?php echo e(old('categoria', $item->categoria) == 'Equipos' ? 'selected' : ''); ?>>Equipos</option>
                            <option value="Reactivos" <?php echo e(old('categoria', $item->categoria) == 'Reactivos' ? 'selected' : ''); ?>>Reactivos</option>
                            <option value="Materiales" <?php echo e(old('categoria', $item->categoria) == 'Materiales' ? 'selected' : ''); ?>>Materiales</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" name="cantidad" value="<?php echo e(old('cantidad', $item->cantidad)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" min="0" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Ubicación</label>
                        <input type="text" name="ubicacion" value="<?php echo e(old('ubicacion', $item->ubicacion)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Proveedor</label>
                        <input type="text" name="proveedor" value="<?php echo e(old('proveedor', $item->proveedor)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" value="<?php echo e(old('fecha_vencimiento', $item->fecha_vencimiento)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Umbral mínimo</label>
                        <input type="number" name="umbral_minimo" value="<?php echo e(old('umbral_minimo', $item->umbral_minimo)); ?>" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" min="1">
                    </div>

                    <div class="flex justify-start gap-3">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Actualizar
                        </button>
                        <a href="<?php echo e(route('items.index')); ?>" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                            Cancelar
                        </a>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/edit.blade.php ENDPATH**/ ?>