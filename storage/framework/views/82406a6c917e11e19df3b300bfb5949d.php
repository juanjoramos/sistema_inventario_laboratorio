<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Sistema Inventario Laboratorio</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/Logo_1.png')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans text-white antialiased bg-gradient-to-br from-indigo-900 via-blue-900 to-slate-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-90">
            <?php echo e($slot); ?>

    </div>
</body>
</html>
<?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/layouts/guest.blade.php ENDPATH**/ ?>