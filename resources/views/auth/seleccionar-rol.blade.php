<x-guest-layout>
    <!-- Contenedor principal con fondo dinámico -->
    <div id="background" class="w-full min-h-screen flex items-center justify-center transition-all duration-1000">
        
        <div class="w-full max-w-sm bg-white from-slate-800 via-gray-800 to-slate-900 text-white rounded-2xl shadow-2xl p-8 relative overflow-hidden">
            
            <!-- Logo -->
            <div class="flex justify-center">
                <img src="{{ asset('images/Logo_1.png') }}" alt="Logo" class="h-20 w-auto rounded-md" />
            </div>

            <!-- Título -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold tracking-tight text-[#013549]">Selecciona tu Rol</h2>
                <p class="text-sm text-[#013549]">Elige cómo ingresar</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulario de selección de rol -->
            <form action="{{ route('dashboard.selector.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid gap-3">
                    @foreach ($user->roles as $role)
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="{{ $role->name }}" class="hidden peer" required>
                            <div class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-3 text-gray-800 dark:text-gray-200 font-semibold 
                                        peer-checked:border-[#013549] peer-checked:bg-[#013549] peer-checked:text-white
                                        hover:shadow-md transition">
                                {{ ucfirst($role->name) }}
                            </div>
                        </label>
                    @endforeach
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
            "{{ asset('images/Login-1.jpg') }}",
            "{{ asset('images/Login-2.jpg') }}",
            "{{ asset('images/Login-3.jpg') }}",
            "{{ asset('images/Login-4.jpg') }}",
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
</x-guest-layout>