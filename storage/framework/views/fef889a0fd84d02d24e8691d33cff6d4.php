<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; font-size: 14px; }
        h1 { color: #1f2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
        .footer { margin-top: 40px; font-size: 12px; color: #888; text-align: center; }
    </style>
</head>
<body>

    <h1>📊 Reporte de <?php echo e(ucfirst($tipo)); ?></h1>
    <p><strong>Periodo:</strong> <?php echo e(ucfirst($periodo)); ?></p>
    <p><strong>Fecha de generación:</strong> <?php echo e(\Carbon\Carbon::now()->format('d/m/Y H:i')); ?></p>

    <h3>Estadísticas</h3>
    <ul>
        <li><strong>Total de ítems:</strong> <?php echo e($estadisticas['total_items'] ?? 'N/A'); ?></li>
        <li><strong>Ítems más usados:</strong> <?php echo e(implode(', ', $estadisticas['items_mas_usados'] ?? [])); ?></li>
        <li><strong>Frecuencia de reabastecimiento:</strong> <?php echo e($estadisticas['frecuencia_reabastecimiento'] ?? 'N/A'); ?></li>
        <li><strong>Tendencias:</strong> <?php echo e($estadisticas['tendencias'] ?? 'N/A'); ?></li>
    </ul>

    <div class="footer">
        Universidad Pascual Bravo – Sistema de Inventario
    </div>

</body>
</html>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/report/plantilla_pdf.blade.php ENDPATH**/ ?>