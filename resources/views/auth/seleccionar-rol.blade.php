<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Selección de Rol
        </h2>
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
