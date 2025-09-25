<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Editar Ítem 📦
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg">
                <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $item->nombre) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Código</label>
                        <input type="text" name="codigo" value="{{ old('codigo', $item->codigo) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Categoría</label>
                        <select name="categoria" class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Equipos" {{ old('categoria', $item->categoria) == 'Equipos' ? 'selected' : '' }}>Equipos</option>
                            <option value="Reactivos" {{ old('categoria', $item->categoria) == 'Reactivos' ? 'selected' : '' }}>Reactivos</option>
                            <option value="Materiales" {{ old('categoria', $item->categoria) == 'Materiales' ? 'selected' : '' }}>Materiales</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" name="cantidad" value="{{ old('cantidad', $item->cantidad) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" min="0" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Ubicación</label>
                        <input type="text" name="ubicacion" value="{{ old('ubicacion', $item->ubicacion) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Proveedor</label>
                        <input type="text" name="proveedor" value="{{ old('proveedor', $item->proveedor) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $item->fecha_vencimiento) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300">Umbral mínimo</label>
                        <input type="number" name="umbral_minimo" value="{{ old('umbral_minimo', $item->umbral_minimo) }}" 
                               class="mt-1 w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm p-2 focus:ring focus:ring-blue-300" min="1">
                    </div>

                    <div class="flex justify-start gap-3">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            Actualizar
                        </button>
                        <a href="{{ route('items.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>