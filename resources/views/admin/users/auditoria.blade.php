<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3 flex items-center gap-3 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L15 12 9.75 7v10z" />
            </svg>
            <h2 class="font-bold text-xl text-blue-800 dark:text-blue-300">
                📋 Historial de Auditoría   
            </h2>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">
        <div>
            <a href="{{ route('users.index') }}" 
               class="inline-flex items-center gap-2 bg-[#293a52] hover:bg-[#1e2c42] text-white px-4 py-2 rounded-lg shadow-md transition">
                ← Volver a Usuarios
            </a>
        </div>

        @if($logs->count())
            @foreach($logs as $log)
                <div class="bg-white p-5 rounded-lg shadow-md border border-gray-200">
                    <div class="grid sm:grid-cols-2 gap-4 text-gray-700">
                        <p><span class="font-semibold text-[#293a52]">👤 Usuario:</span> {{ $log->usuario->name ?? 'Sistema' }}</p>
                        <p><span class="font-semibold text-[#293a52]">🕒 Fecha:</span> {{ $log->created_at->format('d/m/Y H:i') }}</p>
                        <p><span class="font-semibold text-[#293a52]">⚙️ Acción:</span> {{ ucfirst($log->accion) }}</p>
                        <p><span class="font-semibold text-[#293a52]">📌 Modelo afectado:</span> {{ $log->modelo_afectado }} #{{ $log->modelo_id }}</p>
                    </div>
                    
                    <p class="mt-3"><span class="font-semibold text-[#293a52]">📝 Descripción:</span> {{ $log->descripcion }}</p>

                    @if($log->datos_anteriores)
                        <details class="mt-3 bg-gray-50 p-3 rounded-lg">
                            <summary class="cursor-pointer font-semibold text-sm text-[#293a52]">📂 Datos anteriores</summary>
                            <pre class="bg-gray-100 mt-2 p-2 text-xs rounded overflow-x-auto border">{{ json_encode($log->datos_anteriores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </details>
                    @endif

                    @if($log->datos_nuevos)
                        <details class="mt-3 bg-gray-50 p-3 rounded-lg">
                            <summary class="cursor-pointer font-semibold text-sm text-[#293a52]">📁 Datos nuevos</summary>
                            <pre class="bg-gray-100 mt-2 p-2 text-xs rounded overflow-x-auto border">{{ json_encode($log->datos_nuevos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </details>
                    @endif
                </div>
            @endforeach

            <div class="mt-6">
                {{ $logs->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 italic">No hay registros aún.</p>
        @endif
    </div>
</x-app-layout>
