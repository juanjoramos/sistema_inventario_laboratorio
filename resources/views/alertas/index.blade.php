<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-700 dark:text-red-400">Historial de Alertas ⚠️</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-6">
            <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-red-200 dark:bg-red-800 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Ítem</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($alertas as $alerta)
                        <tr>
                            <td class="px-4 py-2">{{ $alerta->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $alerta->item->nombre }}</td>
                            <td class="px-4 py-2">{{ $alerta->cantidad }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $alerta->estado == 'pendiente' ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">
                                    {{ ucfirst($alerta->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if($alerta->estado == 'pendiente')
                                    <form action="{{ route('alertas.atender', $alerta) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                            Marcar como atendida
                                        </button>
                                    </form>
                                @else
                                    ✅
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                No hay alertas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
