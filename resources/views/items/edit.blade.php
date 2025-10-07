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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('items.update', $item->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $item->nombre) }}" required
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Código</label>
                    <input type="text" name="codigo" value="{{ old('codigo', $item->codigo) }}" required
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
                    <select name="categoria" required
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                        <option value="">Seleccione una categoría</option>
                        <option value="Equipos" {{ old('categoria', $item->categoria) == 'Equipos' ? 'selected' : '' }}>Equipos</option>
                        <option value="Reactivos" {{ old('categoria', $item->categoria) == 'Reactivos' ? 'selected' : '' }}>Reactivos</option>
                        <option value="Materiales" {{ old('categoria', $item->categoria) == 'Materiales' ? 'selected' : '' }}>Materiales</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Cantidad</label>
                    <input type="number" name="cantidad" value="{{ old('cantidad', $item->cantidad) }}" min="0" required
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ubicación</label>
                    <input type="text" name="ubicacion" value="{{ old('ubicacion', $item->ubicacion) }}"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Proveedor</label>
                    <input type="text" name="proveedor" value="{{ old('proveedor', $item->proveedor) }}"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de vencimiento</label>
                    <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $item->fecha_vencimiento) }}"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Umbral mínimo</label>
                    <input type="number" name="umbral_minimo" value="{{ old('umbral_minimo', $item->umbral_minimo) }}" min="1"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#293a52]">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit"
                            class="bg-[#293a52] hover:bg-[#1e2c42] text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                        Actualizar
                    </button>
                    <a href="{{ route('items.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>