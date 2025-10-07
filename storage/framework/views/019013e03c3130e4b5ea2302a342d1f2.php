<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Reporte <?php echo e(ucfirst($tipo)); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fbff;
            color: #2c3e50;
            margin: 40px auto;
            max-width: 700px;
            padding: 30px 35px;
            line-height: 1.5;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            font-size: 2.4rem;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        h1 span {
            display: block;
            font-weight: normal;
            font-size: 1.1rem;
            color: #4f6fad;
            margin-top: 6px;
        }

        .periodo {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1rem;
            color: #3b5998;
        }

        strong {
            color: #1e40af;
        }

        h3 {
            font-weight: bold;
            font-size: 1.4rem;
            color: #1e40af;
            border-bottom: 2px solid #93c5fd;
            padding-bottom: 6px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin: 0 0 30px 0;
        }

        ul li {
            background-color: #e0e7ff;
            margin-bottom: 10px;
            padding: 14px 20px;
            border-radius: 10px;
            color: #1e40af;
            font-weight: 600;
            box-shadow: 1px 2px 6px rgba(30, 64, 175, 0.15);
        }

        .tendencias {
            background-color: #f0f5ff;
            padding: 20px 25px;
            border-radius: 10px;
            color: #374785;
            font-size: 1.1rem;
            box-shadow: inset 0 0 10px #a3c4f3;
            font-weight: 400;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #7b8db8;
            font-style: italic;
            border-top: 1px solid #dbeafe;
            padding-top: 18px;
            user-select: none;
        }

        @media (max-width: 480px) {
            body {
                padding: 25px 20px;
                margin: 30px auto;
            }

            h1 {
                font-size: 1.9rem;
            }

            h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <h1>
        Reporte de <?php echo e(ucwords(str_replace('_', ' ', strtolower($tipo)))); ?>

        <span>Estadísticas claras y frescas</span>
    </h1>

    <div class="periodo">
        <p><strong>Periodo:</strong> <?php echo e(ucfirst($periodo)); ?></p>
        <p><strong>Desde:</strong> <?php echo e($estadisticas['fecha_inicio']); ?> | <strong>Hasta:</strong> <?php echo e($estadisticas['fecha_fin']); ?></p>
    </div>

    <section>
        <h3>Items más usados</h3>
        <ul>
            <?php $__empty_1 = true; $__currentLoopData = $estadisticas['items_mas_usados']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li><?php echo e($item); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li>No hay datos registrados en este periodo.</li>
            <?php endif; ?>
        </ul>
    </section>

    <?php if(!empty($estadisticas['frecuencia_reabastecimiento']) && is_array($estadisticas['frecuencia_reabastecimiento'])): ?>
        <section>
            <h3>Frecuencia de Reabastecimiento</h3>
            <ul>
                <?php $__currentLoopData = $estadisticas['frecuencia_reabastecimiento']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $frecuencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?> — <?php echo e(ucfirst($frecuencia)); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </section>
    <?php endif; ?>

<section>
    <h3>Tendencias</h3>

    <?php
        // Asegurarse de que es una colección o array
        $tendencias = is_string($estadisticas['tendencias_consumo'])
            ? json_decode($estadisticas['tendencias_consumo'], true)
            : $estadisticas['tendencias_consumo'];
    ?>

    <?php if(empty($tendencias) || count($tendencias) === 0): ?>
        <p class="tendencias">No hay datos de consumo para este periodo.</p>
    <?php else: ?>
        <ul>
            <?php $__currentLoopData = $tendencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php if($periodo === 'diario'): ?>
                        Fecha: <?php echo e($registro['fecha'] ?? $registro->fecha ?? '-'); ?>

                    <?php elseif($periodo === 'semanal'): ?>
                        Año: <?php echo e($registro['anio'] ?? $registro->anio ?? '-'); ?> - Semana: <?php echo e($registro['semana'] ?? $registro->semana ?? '-'); ?>

                    <?php elseif($periodo === 'mensual'): ?>
                        Mes: <?php echo e($registro['mes'] ?? $registro->mes ?? '-'); ?>

                    <?php endif; ?>
                    — Cantidad consumida: <strong><?php echo e($registro['total_consumido'] ?? $registro->total_consumido ?? '0'); ?></strong>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</section>


    <div class="footer">
        <p>Generado automáticamente el <?php echo e(now()->format('d/m/Y H:i')); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/admin/reportes/pdf.blade.php ENDPATH**/ ?>