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
            Detalle de Ítem: <?php echo e($item->nombre); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6" x-data="{ mostrar: 'transacciones' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                
                
                <div class="mb-6 text-white">
                    <p><strong>Código:</strong> <?php echo e($item->codigo); ?></p>
                    <p><strong>Categoría:</strong> <?php echo e($item->categoria); ?></p>
                    <p><strong>Cantidad disponible:</strong> <?php echo e($item->cantidad); ?></p>
                    <p><strong>Umbral mínimo:</strong> <?php echo e($item->umbral_minimo); ?></p>
                    <p><strong>Ubicación:</strong> <?php echo e($item->ubicacion ?? 'N/A'); ?></p>
                    <p><strong>Proveedor:</strong> <?php echo e($item->proveedor ?? 'N/A'); ?></p>
                    <p><strong>Fecha de vencimiento:</strong> <?php echo e($item->fecha_vencimiento ?? 'No aplica'); ?></p>
                </div>

                
                <?php if(auth()->user()->hasRole('admin')): ?>
                    <div class="flex gap-3 mb-6">
                        <a href="<?php echo e(route('items.edit', $item)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                            ✏️ Editar Ítem
                        </a>
                        <a href="<?php echo e(route('items.editStock', $item)); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            🔄 Actualizar Stock
                        </a>
                    </div>
                <?php endif; ?>

                
                <div class="flex space-x-3 mb-4">
                    <button @click="mostrar = 'transacciones'" 
                            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700"
                            :class="{'bg-indigo-800': mostrar === 'transacciones'}">
                        📦 Historial de Transacciones
                    </button>
                    <button @click="mostrar = 'reservas'" 
                            class="px-4 py-2 rounded bg-teal-600 text-white hover:bg-teal-700"
                            :class="{'bg-teal-800': mostrar === 'reservas'}">
                        📘 Historial de Reservas
                    </button>
                </div>

                
                <div x-show="mostrar === 'transacciones'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2">📦 Historial de Transacciones</h4>
                    <?php if($item->transacciones->isEmpty()): ?>
                        <p class="text-gray-500">No hay transacciones registradas aún.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Fecha</th>
                                        <th class="px-4 py-2 text-left">Tipo</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                                    <?php $__currentLoopData = $item->transacciones->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-4 py-2"><?php echo e($t->created_at->format('d/m/Y H:i')); ?></td>
                                            <td class="px-4 py-2 capitalize"><?php echo e($t->tipo); ?></td>
                                            <td class="px-4 py-2"><?php echo e($t->cantidad); ?></td>
                                            <td class="px-4 py-2"><?php echo e($t->descripcion); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div x-show="mostrar === 'reservas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2">📘 Historial de Reservas</h4>
                    <?php if($item->reservas->isEmpty()): ?>
                        <p class="text-gray-500">Este ítem no ha sido reservado aún.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Usuario</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Fecha de Reserva</th>
                                        <th class="px-4 py-2 text-left">Fecha de Devolución</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-white">
                                    <?php $__currentLoopData = $item->reservas->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-4 py-2"><?php echo e($reserva->user->email ?? 'Usuario desconocido'); ?></td>
                                            <td class="px-4 py-2"><?php echo e($reserva->cantidad ?? 1); ?></td>
                                            <td class="px-4 py-2"><?php echo e($reserva->created_at->format('d/m/Y H:i')); ?></td>
                                            <td class="px-4 py-2">
                                                <?php if($reserva->fecha_devolucion_real): ?>
                                                    <?php echo e($reserva->fecha_devolucion_real->format('d/m/Y H:i')); ?>

                                                <?php else: ?>
                                                    <span class="text-gray-400">
                                                        <?php echo e($reserva->estado === 'devuelto' ? 'Sin fecha registrada' : 'No devuelto'); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-2">
                                                <?php switch($reserva->estado):
                                                    case ('pendiente'): ?> <span class="text-yellow-400">Pendiente</span> <?php break; ?>
                                                    <?php case ('entregado'): ?>  <span class="text-blue-400">Entregado</span> <?php break; ?>
                                                    <?php case ('devuelto'): ?>  <span class="text-green-500">Devuelto</span> <?php break; ?>
                                                    <?php case ('cancelado'): ?> <span class="text-red-500">Cancelado</span> <?php break; ?>
                                                    <?php default: ?> <span class="text-gray-400"><?php echo e($reserva->estado); ?></span>
                                                <?php endswitch; ?>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/items/show.blade.php ENDPATH**/ ?>