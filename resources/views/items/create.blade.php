<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                Registrar nuevo Ítem 📦
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <form action="{{ route('items.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                        <input type="text" name="nombre" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Código</label>
                        <input type="text" name="codigo" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                        <select name="categoria" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Equipos">Equipos</option>
                            <option value="Reactivos">Reactivos</option>
                            <option value="Materiales">Materiales</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Cantidad</label>
                        <input type="number" name="cantidad" min="0"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Ubicación</label>
                        <input type="text" name="ubicacion"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Proveedor</label>
                        <input type="text" name="proveedor"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Umbral mínimo</label>
                        <input type="number" name="umbral_minimo" value="5" min="1"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md font-medium transition">
                            Guardar
                        </button>
                        <a href="{{ route('dashboard.admin') }}" 
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg shadow-md font-medium transition">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
