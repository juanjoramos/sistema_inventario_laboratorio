<x-guest-layout>
        <div class="w-full max-w-sm bg-gradient-to-br from-slate-800 via-gray-800 to-slate-900 text-white rounded-2xl shadow-2xl p-8 relative overflow-hidden">

            <!-- Imagen arriba del formulario -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/Logo_1.png') }}" alt="Logo" 
                    class="h-20 w-auto rounded-md filter brightness-0 invert" />
            </div>

            <!-- Título -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold tracking-tight text-indigo-400">¡Bienvenido!</h2>
                <p class="text-sm text-gray-400">Ingresa tus credenciales para continuar</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-indigo-300" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="mt-1 block w-full bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-indigo-300" />
                    <x-text-input id="password" type="password" name="password" required
                        class="mt-1 block w-full bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between text-sm mb-6">
                    <label for="remember_me" class="inline-flex items-center text-gray-300">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-slate-600 bg-slate-700 text-indigo-400 focus:ring-indigo-400 mr-2">
                        Recuérdame
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-indigo-300 hover:text-indigo-200 transition" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full py-3 rounded-lg bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-500 hover:to-blue-400 transition-all duration-300 font-semibold shadow-md hover:shadow-indigo-500/30">
                        INICIAR SESIÓN
                    </button>
                </div>
            </form>
        </div>
</x-guest-layout>