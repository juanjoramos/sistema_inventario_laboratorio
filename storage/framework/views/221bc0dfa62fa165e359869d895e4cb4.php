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
                Gestión de Usuarios
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="flex flex-wrap items-center gap-2">
                <input type="text" name="email" placeholder="Buscar por correo"
                    value="<?php echo e(request('email')); ?>"
                    class="border border-gray-300 dark:border-gray-700 rounded px-3 py-2 w-64 dark:bg-gray-800 dark:text-white" />
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-1">
                    🔍 Buscar
                </button>
                <a href="<?php echo e(route('admin.users.index')); ?>"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Limpiar
                </a>
            </form>

            <div class="flex gap-2">
                <a href="<?php echo e(route('users.create')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-1">
                    ➕ Crear Usuario
                </a>
                <a href="<?php echo e(route('admin.auditoria')); ?>" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded flex items-center gap-1">
                    🕵️‍♂️ Auditoría
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-left text-gray-800 dark:text-gray-200">
                <thead class="bg-blue-200 dark:bg-blue-800 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Correo</th>
                        <th class="px-4 py-2 border">Roles</th>
                        <th class="px-4 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <td class="border px-4 py-2"><?php echo e($user->id); ?></td>
                            <td class="border px-4 py-2"><?php echo e($user->name); ?></td>
                            <td class="border px-4 py-2"><?php echo e($user->email); ?></td>
                            <td class="border px-4 py-2"><?php echo e($user->roles->pluck('name')->join(', ')); ?></td>
                            <td class="border px-4 py-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo e(route('users.edit', $user)); ?>"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center px-4 py-4 text-gray-500 dark:text-gray-400">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-4 px-4 py-2">
                <?php echo e($users->links('pagination::tailwind')); ?>

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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/admin/users/index.blade.php ENDPATH**/ ?>