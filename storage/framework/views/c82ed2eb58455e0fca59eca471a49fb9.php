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
            Registrar nuevo ítem
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <form action="<?php echo e(route('items.store')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="nombre" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Código</label>
                        <input type="text" name="codigo" class="w-full border-gray-300 rounded-lg" required>
                    </div>
                    
                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                        <select name="categoria" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Equipos">Equipos</option>
                            <option value="Reactivos">Reactivos</option>
                            <option value="Materiales">Materiales</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" name="cantidad" class="w-full border-gray-300 rounded-lg" min="0" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                        <input type="text" name="ubicacion" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Proveedor</label>
                        <input type="text" name="proveedor" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Umbral mínimo</label>
                        <input type="number" name="umbral_minimo" class="w-full border-gray-300 rounded-lg" value="5" min="1">
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Guardar
                        </button>
                        <a href="<?php echo e(route('dashboard.admin')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
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
<?php endif; ?>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/create.blade.php ENDPATH**/ ?>