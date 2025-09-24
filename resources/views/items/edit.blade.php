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

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $item->nombre) }}" 
                               class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Código</label>
                        <input type="text" name="codigo" value="{{ old('codigo', $item->codigo) }}" 
                               class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                        <select name="categoria" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Equipos" {{ old('categoria', $item->categoria) == 'Equipos' ? 'selected' : '' }}>Equipos</option>
                            <option value="Reactivos" {{ old('categoria', $item->categoria) == 'Reactivos' ? 'selected' : '' }}>Reactivos</option>
                            <option value="Materiales" {{ old('categoria', $item->categoria) == 'Materiales' ? 'selected' : '' }}>Materiales</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" name="cantidad" value="{{ old('cantidad', $item->cantidad) }}" 
                               class="w-full border-gray-300 rounded-lg" min="0" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                        <input type="text" name="ubicacion" value="{{ old('ubicacion', $item->ubicacion) }}" 
                               class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Proveedor</label>
                        <input type="text" name="proveedor" value="{{ old('proveedor', $item->proveedor) }}" 
                               class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $item->fecha_vencimiento) }}" 
                               class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 dark:text-gray-300">Umbral mínimo</label>
                        <input type="number" name="umbral_minimo" value="{{ old('umbral_minimo', $item->umbral_minimo) }}" 
                               class="w-full border-gray-300 rounded-lg" min="1">
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Actualizar
                        </button>
                        <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
