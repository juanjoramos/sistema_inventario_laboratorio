<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Selecciona tu Rol
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto bg-[#293a52] dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-6 text-white">Elige cómo ingresar</h2>

            <form action="{{ route('dashboard.selector.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid gap-3">
                    @foreach ($user->roles as $role)
                        <label class="cursor-pointer block">
                            <input type="radio" name="role" value="{{ $role->name }}" class="hidden peer" required>
                            <div class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-3 text-gray-800 dark:text-gray-200 font-semibold 
                                        peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white
                                        hover:shadow-md transition">
                                {{ ucfirst($role->name) }}
                            </div>
                        </label>
                    @endforeach
                </div>

                <button type="submit"
                        class="mt-6 w-full px-5 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold shadow-md hover:from-blue-700 hover:to-blue-800 transition">
                    Ingresar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>