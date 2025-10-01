<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Contenedor principal con fondo dinámico -->
    <div id="background" class="w-full min-h-screen flex items-center justify-center transition-all duration-1000">
        
        <div class="w-full max-w-sm bg-white from-slate-800 via-gray-800 to-slate-900 text-white rounded-2xl shadow-2xl p-8 relative overflow-hidden">
            
            <!-- Logo -->
            <div class="flex justify-center">
                <img src="<?php echo e(asset('images/Logo_1.png')); ?>" alt="Logo" class="h-20 w-auto rounded-md" />
            </div>

            <!-- Título -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold tracking-tight text-[#013549]">Selecciona tu Rol</h2>
                <p class="text-sm text-[#013549]">Elige cómo ingresar</p>
            </div>

            <!-- Session Status -->
            <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

            <!-- Formulario de selección de rol -->
            <form action="<?php echo e(route('dashboard.selector.submit')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div class="grid gap-3">
                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="<?php echo e($role->name); ?>" class="hidden peer" required>
                            <div class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-3 text-gray-800 dark:text-gray-200 font-semibold 
                                        peer-checked:border-[#013549] peer-checked:bg-[#013549] peer-checked:text-white
                                        hover:shadow-md transition">
                                <?php echo e(ucfirst($role->name)); ?>

                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Botón de envío -->
                <button type="submit"
                    class="mt-6 w-full py-3 rounded-lg bg-[#013549] hover:bg-[#02506a] transition-all duration-300 font-semibold text-white shadow-md hover:shadow-[#013549]/30">
                    Ingresar
                </button>
            </form>
        </div>
    </div>

    <script>
        const background = document.getElementById('background');
        const images = [
            "<?php echo e(asset('images/Login-1.jpg')); ?>",
            "<?php echo e(asset('images/Login-2.jpg')); ?>",
            "<?php echo e(asset('images/Login-3.jpg')); ?>",
            "<?php echo e(asset('images/Login-4.jpg')); ?>",
        ];
        let index = 0;

        function changeBackground() {
            const img = new Image();
            img.src = images[index];
            img.onload = () => {
                background.style.backgroundImage = `url('${images[index]}')`;
                background.style.transition = 'background-image 1s ease-in-out';
                index = (index + 1) % images.length;
            }
        }

        changeBackground();
        setInterval(changeBackground, 8000);
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\Users\jramo\sistema_inventario_laboratorios\resources\views/auth/seleccionar-rol.blade.php ENDPATH**/ ?>