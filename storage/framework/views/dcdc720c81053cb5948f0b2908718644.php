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
                Crear Usuario
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        
        <?php if($errors->any()): ?>
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                <ul class="list-disc list-inside space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('users.store')); ?>" method="POST" class="bg-white p-6 rounded-lg shadow-md border border-gray-200 max-w-lg mx-auto">
            <?php echo csrf_field(); ?>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                <input type="text" 
                       name="name" 
                       value="<?php echo e(old('name')); ?>" 
                       placeholder="Nombre completo" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Correo institucional</label>
                <input type="email" 
                       name="email" 
                       value="<?php echo e(old('email')); ?>" 
                       placeholder="ejemplo@pascualbravo.edu.co" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                <input type="password" 
                       name="password" 
                       placeholder="********" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
                <input type="password" 
                       name="password_confirmation" 
                       placeholder="********" 
                       required 
                       class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Asignar Roles</label>
                <div class="space-y-2">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center gap-2 text-gray-700">
                            <input type="checkbox" 
                                   name="roles[]" 
                                   value="<?php echo e($role->id); ?>"
                                   class="rounded text-[#293a52] focus:ring-[#293a52]"
                                   <?php echo e((is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : ''); ?>>
                            <?php echo e($role->name); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-[#293a52] hover:bg-[#1e2c42] text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                    Guardar
                </button>
            </div>
        </form>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/admin/users/create.blade.php ENDPATH**/ ?>