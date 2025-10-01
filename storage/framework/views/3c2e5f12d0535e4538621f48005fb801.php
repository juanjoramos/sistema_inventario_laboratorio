<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f7; padding: 20px; }
        .card {
            background: #fff;
            border-left: 6px solid #10b981;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }
        h1 { color: #10b981; }
        p { font-size: 16px; line-height: 1.5; }
        .footer { margin-top: 20px; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="card">
        <h1>✅ Confirmación de Reserva</h1>
        <p>Hola <?php echo e($reserva->user->name); ?>!</p>
        <p>Tu reserva del ítem <strong><?php echo e($reserva->item->nombre); ?></strong> ha sido registrada exitosamente.</p>
        <p><strong>Cantidad:</strong> <?php echo e($reserva->cantidad); ?></p>
        <p><strong>Fecha de devolución prevista:</strong> <?php echo e($reserva->fecha_devolucion_prevista->format('d/m/Y')); ?></p>
        <p>Gracias por usar nuestro sistema.</p>
    </div>

    <div class="footer">
        📌 Sistema de Inventario - Universidad Pascual Bravo
    </div>
</body>
</html>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/emails/reserva_confirmada.blade.php ENDPATH**/ ?>