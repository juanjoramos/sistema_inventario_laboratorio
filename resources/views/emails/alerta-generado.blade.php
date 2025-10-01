<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta Generada</title>
</head>
<body>
    <h2>⚠️ Nueva alerta en el sistema</h2>
    <p><strong>Descripción:</strong> {{ $alerta->descripcion }}</p>
    <p><strong>Creada por:</strong> {{ $alerta->usuario->name }}</p>
    <p><strong>Fecha:</strong> {{ $alerta->created_at }}</p>
</body>
</html>
