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
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 text-center">
            <h2 class="text-white font-bold mb-4">Selecciona tu rol</h2>

            <form action="{{ route('dashboard.selector.submit') }}" method="POST">
                @csrf
                @foreach ($user->roles as $role)
                    <div class="mb-2">
                        <label class="flex items-center justify-center gap-2 text-white">
                            <input type="radio" name="role" value="{{ $role->name }}" required>
                            <span>{{ ucfirst($role->name) }}</span>
                        </label>
                    </div>
                @endforeach

                <button type="submit" 
                        class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Ingresar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
