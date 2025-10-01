<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f7; padding: 20px; }
        .card {
            background: #fff;
            border-left: 6px solid #e3342f;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }
        h1 { color: #e3342f; }
        p { font-size: 16px; }
        .footer { margin-top: 20px; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="card">
        <h1>⚠️ Alerta de Inventario</h1>
        <p>El ítem <strong><?php echo e($item); ?></strong> tiene solo <strong><?php echo e($cantidad); ?></strong> unidades disponibles.</p>
        <p>Por favor toma acción para reabastecerlo a tiempo.</p>
    </div>

    <div class="footer">
        📌 Sistema de Inventario - Universidad Pascual Bravo
    </div>
</body>
</html>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/emails/stock_low.blade.php ENDPATH**/ ?>