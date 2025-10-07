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
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v2H5a2 2 0 01-2-2V7a2 2 0 012-2h4v2H5v10h4zm10-6h-8v2h8v-2zm0-4h-8v2h8V7zm0 8h-8v2h8v-2z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Generación de Reportes
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="p-6 flex justify-center">
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-8 w-full max-w-2xl border border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100 text-center">
                📊 Formulario para Generar Reportes
            </h1>

            <form action="<?php echo e(route('reports.generar')); ?>" method="GET" class="space-y-6">
                <!-- Tipo de informe -->
                <div>
                    <label for="tipo" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Informe</label>
                    <select id="tipo" name="tipo" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Seleccione una opción...</option>
                        <option value="stock">📦 Stock</option>
                        <option value="prestamos">🕓 Historial de Préstamos</option>
                        <option value="consumo_reactivos">⚗️ Consumo de Reactivos</option>
                        <option value="equipos_usados">🔬 Equipos Usados</option>
                    </select>
                </div>

                <!-- Periodo -->
                <div>
                    <label for="periodo" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Periodo</label>
                    <select id="periodo" name="periodo" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Seleccione un periodo...</option>
                        <option value="diario">📅 Diario</option>
                        <option value="semanal">🗓️ Semanal</option>
                        <option value="mensual">📈 Mensual</option>
                    </select>
                </div>

                <!-- Formato -->
                <div>
                    <label for="formato" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Formato</label>
                    <select id="formato" name="formato" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-gray-50 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500">
                        <option value="pdf">📄 PDF</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex justify-center gap-4 pt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
                        ⚙️ Generar Informe
                    </button>

                    <a href="<?php echo e(route('reports.forms')); ?>"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
                        🔄 Limpiar
                    </a>
                </div>
            </form>
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
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/reports/forms.blade.php ENDPATH**/ ?>