<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Inventario')</title>
    <!-- Aquí tus CSS/JS (Tailwind / Bootstrap / mix) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="antialiased">
    {{-- navegación, header, etc --}}
    @include('layouts.navigation') {{-- si tienes este partial --}}

    <main class="py-6">
        {{-- El contenido que envíes desde <x-app-layout> aparecerá aquí --}}
        {{ $slot }}
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
