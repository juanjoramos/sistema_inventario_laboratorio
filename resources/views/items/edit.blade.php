<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar ítem
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <form action="{{ route('items.update', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT') <!-- 👈 IMPORTANTE -->

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
                        <input type="text" name="categoria" value="{{ old('categoria', $item->categoria) }}" 
                               class="w-full border-gray-300 rounded-lg" required>
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
