<x-guest-layout>
    <div class="w-full max-w-sm bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white rounded-2xl shadow-2xl p-8 relative overflow-hidden">

        <div class="flex justify-center mb-3">
            <img src="{{ asset('images/Logo_1.png') }}" alt="Logo" class="h-24 w-auto rounded-md filter brightness-0 invert" />
        </div>

        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold tracking-wide text-indigo-300">Crear cuenta</h2>
            <p class="text-sm text-gray-400">Regístrate para acceder al sistema</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre completo')" class="text-indigo-300" />
                <x-text-input id="name" class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400"
                              type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Correo electrónico')" class="text-indigo-300" />
                <x-text-input id="email" class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400"
                              type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Contraseña')" class="text-indigo-300" />
                <x-text-input id="password" class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400"
                              type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-indigo-300" />
                <x-text-input id="password_confirmation" class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400 px-3 py-2 placeholder-gray-400"
                              type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400" />
            </div>

            <div class="mb-6">
                <x-input-label :value="__('Selecciona tu rol')" class="text-indigo-300" />
                <div class="flex flex-col gap-2 mt-2 text-gray-300">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="profesor" class="rounded border-gray-600 bg-gray-700 text-indigo-400 focus:ring-indigo-400">
                        <span class="ml-2">Profesor</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="estudiante" class="rounded border-gray-600 bg-gray-700 text-indigo-400 focus:ring-indigo-400">
                        <span class="ml-2">Estudiante</span>
                    </label>

<label class="inline-flex items-center">
    <input type="checkbox" name="roles[]" value="ambas" id="ambas" onclick="seleccionarAmbas(this)" 
           class="rounded border-gray-600 bg-gray-700 text-indigo-400 focus:ring-indigo-400">
    <span class="ml-2">Ambas</span>
</label>

                </div>
                <x-input-error :messages="$errors->get('roles')" class="mt-1 text-red-400" />
            </div>

            <div class="flex items-center justify-between">
                <a class="underline text-sm text-indigo-300 hover:text-indigo-200 transition" href="{{ route('login') }}">
                    ¿Ya tienes cuenta?
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-400 hover:to-blue-400 transition-all duration-300 font-semibold shadow-lg hover:shadow-indigo-500/30">
                    REGISTRAR
                </button>
            </div>
        </form>
    </div>

<script>
    function seleccionarAmbas(checkbox) {
        let prof = document.querySelector('input[value="profesor"]');
        let est = document.querySelector('input[value="estudiante"]');

        if (checkbox.checked) {
            prof.checked = true;
            est.checked = true;
        } else {
            prof.checked = false;
            est.checked = false;
        }
    }
</script>

</x-guest-layout>
