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
                Detalle de Ítem: <?php echo e($item->nombre); ?>

            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6" x-data="{ mostrar: '<?php echo e(request('tab', 'transacciones')); ?>', mostrarEstadisticas: false }">
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
                    <button @click="mostrar = 'transacciones'; window.history.replaceState(null, '', '?tab=transacciones')" 
                            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700"
                            :class="{'bg-indigo-800': mostrar === 'transacciones'}">
                        📦 Historial de Transacciones
                    </button>

                    <button @click="mostrar = 'reservas'; window.history.replaceState(null, '', '?tab=reservas')" 
                            class="px-4 py-2 rounded bg-teal-600 text-white hover:bg-teal-700"
                            :class="{'bg-teal-800': mostrar === 'reservas'}">
                        📘 Historial de Reservas
                    </button>

                    <button @click="mostrar = 'alertas'; window.history.replaceState(null, '', '?tab=alertas')" 
                            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700"
                            :class="{'bg-red-800': mostrar === 'alertas'}">
                        ⚠️ Historial de Alertas
                    </button>
                </div>

                <div x-show="mostrar === 'transacciones'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">📦 Historial de Transacciones</h4>
                    <?php if($transacciones->isEmpty()): ?>
                        <p class="text-gray-500">No hay transacciones registradas aún.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto mb-4">
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
                                    <?php $__currentLoopData = $transacciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-4 py-2"><?php echo e($t->created_at->format('d/m/Y H:i')); ?></td>
                                            <td class="px-4 py-2 capitalize"><?php echo e($t->tipo); ?></td>
                                            <td class="px-4 py-2"><?php echo e($t->cantidad); ?></td>
                                            <td class="px-4 py-2">
                                                <?php if($t->usuario): ?>
                                                    Prestado por <?php echo e($t->usuario->email); ?>

                                                <?php else: ?>
                                                    <?php echo e($t->descripcion); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            <?php echo e($transacciones->appends(['tab' => 'transacciones'])->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div x-show="mostrar === 'reservas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">📘 Historial de Reservas</h4>
                    <?php if($reservas->isEmpty()): ?>
                        <p class="text-gray-500">Este ítem no ha sido reservado aún.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto mb-4">
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
                                    <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <div class="mt-2">
                            <?php echo e($reservas->appends(['tab' => 'reservas'])->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div x-show="mostrar === 'alertas'" x-cloak>
                    <h4 class="text-lg font-semibold mb-2 text-white">⚠️ Historial de Alertas</h4>

                    <button @click="mostrarEstadisticas = !mostrarEstadisticas"
                        class="mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow">
                        <span x-text="mostrarEstadisticas ? 'Ocultar Estadísticas' : 'Mostrar Estadísticas'"></span>
                    </button>

                    <div x-show="mostrarEstadisticas" x-transition>
                        <?php
                            $totalAlertas = $alertas->count();
                            $pendientes = $alertas->where('estado', 'pendiente')->count();
                            $atendidas = $alertas->where('estado', 'atendida')->count();
                        ?>

                        <div class="flex gap-4 mb-4">
                            <div class="bg-yellow-500 text-black px-4 py-2 rounded shadow">
                                Pendientes: <span class="font-bold"><?php echo e($pendientes); ?></span>
                            </div>
                            <div class="bg-green-600 text-white px-4 py-2 rounded shadow">
                                Atendidas: <span class="font-bold"><?php echo e($atendidas); ?></span>
                            </div>
                            <div class="bg-gray-700 text-white px-4 py-2 rounded shadow">
                                Total: <span class="font-bold"><?php echo e($totalAlertas); ?></span>
                            </div>
                        </div>
                        <div class="w-full max-w-md mb-4">
                            <canvas id="alertasChart"></canvas>
                        </div>
                    </div>

                    <?php if($alertas->isEmpty()): ?>
                        <p class="text-gray-400">Este ítem no tiene alertas registradas.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto mb-4">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-[#293a52] rounded-lg shadow">
                                <thead class="bg-[#293a52] text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Fecha</th>
                                        <th class="px-4 py-2 text-left">Ítem Afectado</th>
                                        <th class="px-4 py-2 text-left">Cantidad</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-white">
                                    <?php $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-4 py-2"><?php echo e($alerta->created_at->format('d/m/Y H:i')); ?></td>
                                            <td class="px-4 py-2"><?php echo e($item->nombre); ?></td>
                                            <td class="px-4 py-2"><?php echo e($alerta->cantidad); ?></td>
                                            <td class="px-4 py-2">
                                                <?php switch($alerta->estado):
                                                    case ('pendiente'): ?> 
                                                        <span class="px-2 py-1 bg-yellow-500 text-black rounded">Pendiente</span> 
                                                        <?php break; ?>
                                                    <?php case ('atendida'): ?> 
                                                        <span class="px-2 py-1 bg-green-600 text-white rounded">Atendida</span> 
                                                        <?php break; ?>
                                                    <?php default: ?> 
                                                        <span class="px-2 py-1 bg-gray-500 text-white rounded"><?php echo e($alerta->estado); ?></span>
                                                <?php endswitch; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            <?php echo e($alertas->appends(['tab' => 'alertas'])->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('alertasChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut', // bar grafico de barras o doughnut grafico circular
                data: {
                    labels: ['Pendientes', 'Atendidas'],
                    datasets: [{
                        data: [<?php echo e($pendientes); ?>, <?php echo e($atendidas); ?>],
                        backgroundColor: ['#facc15', '#22c55e'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        });
    </script>
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