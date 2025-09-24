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
                📋 Historial de Auditoría   
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6 space-y-4">
        <div class="mb-4">
            <a href="<?php echo e(route('users.index')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded">
                ← Volver a Usuarios
            </a>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded shadow border">
                <p><strong>👤 Usuario:</strong> <?php echo e($log->usuario->name ?? 'Sistema'); ?></p>
                <p><strong>🕒 Fecha:</strong> <?php echo e($log->created_at->format('d/m/Y H:i')); ?></p>
                <p><strong>⚙️ Acción:</strong> <?php echo e(ucfirst($log->accion)); ?></p>
                <p><strong>📌 Modelo afectado:</strong> <?php echo e($log->modelo_afectado); ?> #<?php echo e($log->modelo_id); ?></p>
                <p><strong>📝 Descripción:</strong> <?php echo e($log->descripcion); ?></p>

                <?php if($log->datos_anteriores): ?>
                    <details class="mt-2">
                        <summary class="cursor-pointer text-sm text-gray-600">📂 Datos anteriores</summary>
                        <pre class="bg-gray-100 p-2 text-sm rounded overflow-x-auto">
                        <?php echo e(json_encode($log->datos_anteriores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?>

                        </pre>
                    </details>
                <?php endif; ?>

                <?php if($log->datos_nuevos): ?>
                    <details class="mt-2">
                        <summary class="cursor-pointer text-sm text-gray-600">📁 Datos nuevos</summary>
                        <pre class="bg-gray-100 p-2 text-sm rounded overflow-x-auto">
                        <?php echo e(json_encode($log->datos_nuevos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?>

                        </pre>
                    </details>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-600">No hay registros aún.</p>
        <?php endif; ?>

        <div class="mt-6">
            <?php echo e($logs->links()); ?>

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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/admin/users/auditoria.blade.php ENDPATH**/ ?>