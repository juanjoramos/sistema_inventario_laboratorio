<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Inventarios - I.U. Pascual Bravo</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_1.svg') }}"style="background-color:#fff;">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif
        }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">
    <div class="min-h-screen flex flex-col justify-between">

        <header class="sticky top-0 z-50" style="background-color:#fff;">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
               <h1 class="flex items-center gap-3 text-2xl font-bold tracking-wide" style="color:#293a52;">
                    <img src="{{ asset('images/Logo_1.png') }}" alt="Logo" class="h-8 w-8 color-black rounded"    >
                    Inventario de Laboratorios
                </h1>

                <nav class="space-x-6 font-semibold">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-black hover:text-gray-300 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow transition">Iniciar sesión</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="flex-grow">
            <section class="relative text-center py-20 px-6 bg-gray-100" style="background-color:#293a52">
                <h2 class="text-4xl font-extrabold mb-4 text-gray-900 text-white">Sistema de Inventarios</h2>
                <p class="text-lg max-w-3xl mx-auto text-gray-700 text-white">
                    Administra de manera ágil, segura y eficiente el inventario de equipos, reactivos y materiales de los laboratorios de la Institución Universitaria Pascual Bravo.
                </p>
            </section>

            <section id="modulos" class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-3 gap-8">
                <div id="reactivos" class="bg-white border border-gray-200 rounded-2xl p-8 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-900 text-center">🧪 Reactivos</h3>
                    <p class="text-gray-700 text-center">Controla el stock, las fechas de vencimiento y el uso seguro de los reactivos.</p>
                </div>
                <div id="equipos" class="bg-white border border-gray-200 rounded-2xl p-8 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-900 text-center">⚙️ Equipos</h3>
                    <p class="text-gray-700 text-center">Registra y gestiona el préstamo de equipos de laboratorio de manera organizada.</p>
                </div>
                <div id="materiales" class="bg-white border border-gray-200 rounded-2xl p-8 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-900 text-center">📦 Materiales</h3>
                    <p class="text-gray-700 text-center">Administra materiales de uso general para garantizar la disponibilidad continua en los laboratorios.</p>
                </div>
            </section>
        </main>