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
        <h2 class="font-semibold text-xl">Usuarios</h2>
     <?php $__env->endSlot(); ?>

    <div class="p-6">

        <!-- 🔍 Formulario de búsqueda por correo -->
        <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="mb-4">
            <input type="text" name="email" placeholder="Buscar por correo"
                value="<?php echo e(request('email')); ?>"
                class="border rounded px-3 py-1 w-1/3" />
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded ml-2">Buscar</button>
                <a href="<?php echo e(route('admin.users.index')); ?>"
            class="bg-blue-600 text-white px-3 py-1 rounded ml-2">
                Limpiar
            </a>
        </form>

        <a href="<?php echo e(route('users.create')); ?>" class="bg-blue-600 text-white px-3 py-1 rounded">+ Crear Usuario</a>
        <a href="<?php echo e(route('admin.auditoria')); ?>" class="bg-gray-700 text-white px-3 py-1 rounded ml-2">Ver Historial de Auditoría</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Nombre</th>
                    <th class="border px-2 py-1">Correo</th>
                    <th class="border px-2 py-1">Roles</th>
                    <th class="border px-2 py-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border px-2 py-1"><?php echo e($user->id); ?></td>
                        <td class="border px-2 py-1"><?php echo e($user->name); ?></td>
                        <td class="border px-2 py-1"><?php echo e($user->email); ?></td>
                        <td class="border px-2 py-1">
                            <?php echo e($user->roles->pluck('name')->join(', ')); ?>

                        </td>
                        <td class="border px-2 py-1">
                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" style="display:inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="bg-red-600 text-white px-2 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
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