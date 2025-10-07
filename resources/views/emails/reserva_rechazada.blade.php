<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f7; padding: 20px; }
        .card {
            background: #fff;
            border-left: 6px solid #ef4444;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }
        h1 { color: #ef4444; }
        p { font-size: 16px; line-height: 1.5; }
        .footer { margin-top: 20px; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="card">
        <h1>❌ Reserva Rechazada</h1>
        <p>Hola {{ $reserva->user->name }}!</p>
        <p>Tu reserva del ítem <strong>{{ $reserva->item->nombre }}</strong> ha sido <strong>rechazada</strong> por el administrador.</p>
        <p><strong>Cantidad:</strong> {{ $reserva->cantidad }}</p>
        <p><strong>Fecha de devolución prevista:</strong> {{ $reserva->fecha_devolucion_prevista->format('d/m/Y') }}</p>
        <p>Si tienes dudas, por favor contacta al administrador.</p>
    </div>

    <div class="footer">
        📌 Sistema de Inventario - Universidad Pascual Bravo
    </div>
</body>
</html>