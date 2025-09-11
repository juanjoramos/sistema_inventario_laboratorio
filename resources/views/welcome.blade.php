<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Inventarios - I.U. Pascual Bravo</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-900 text-white">
    <div class="min-h-screen flex flex-col justify-between">

        <!-- HEADER -->
        <header class="sticky top-0 z-50 bg-gradient-to-r from-blue-800/90 to-indigo-700/90 backdrop-blur-lg shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
                <h1 class="text-3xl font-extrabold tracking-wide">🔬 Inventario de Laboratorios</h1>
                <nav class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-200 hover:text-white transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 shadow-md transition">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-green-500 hover:bg-green-600 shadow-md transition">Registrarse</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <!-- HERO -->
        <main class="flex-grow">
            <section class="relative text-center py-20 px-6 bg-gradient-to-r from-indigo-900 via-blue-800 to-blue-600 overflow-hidden">
                <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-20"></div>
                <h2 class="text-5xl font-extrabold mb-4 animate-fade-in">Sistema de Inventarios</h2>
                <p class="text-lg text-gray-200 max-w-3xl mx-auto mb-6">
                    Administra el inventario de equipos, reactivos y materiales de los laboratorios de la Institución Universitaria Pascual Bravo de manera ágil, segura y eficiente.
                </p>
            </section>

            <!-- MÓDULOS -->
            <section id="modulos" class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6 py-16">
                <div class="bg-gray-800/60 backdrop-blur-lg rounded-2xl p-8 shadow-lg hover:scale-105 transition">
                    <h3 class="text-2xl font-semibold mb-3 text-center">🧪 Reactivos</h3>
                    <p class="text-gray-300 text-center">Controla el stock, fechas de vencimiento y uso seguro de los reactivos.</p>
                </div>
                <div class="bg-gray-800/60 backdrop-blur-lg rounded-2xl p-8 shadow-lg hover:scale-105 transition">
                    <h3 class="text-2xl font-semibold mb-3 text-center">⚙️ Equipos</h3>
                    <p class="text-gray-300 text-center">Registra y gestiona el préstamo de equipos de laboratorio.</p>
                </div>
                <div class="bg-gray-800/60 backdrop-blur-lg rounded-2xl p-8 shadow-lg hover:scale-105 transition">
                    <h3 class="text-2xl font-semibold mb-3 text-center">📦 Materiales</h3>
                    <p class="text-gray-300 text-center">Administra materiales de uso general para garantizar disponibilidad continua.</p>
                </div>
            </section>

            <!-- ESTADÍSTICAS -->
            <section class="bg-gray-900 py-16 text-center">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div>
                        <h4 class="text-4xl font-bold text-blue-400">+500</h4>
                        <p class="text-gray-400">Registros en inventario</p>
                    </div>
                    <div>
                        <h4 class="text-4xl font-bold text-green-400">+120</h4>
                        <p class="text-gray-400">Usuarios activos</p>
                    </div>
                    <div>
                        <h4 class="text-4xl font-bold text-yellow-400">+15</h4>
                        <p class="text-gray-400">Laboratorios gestionados</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
