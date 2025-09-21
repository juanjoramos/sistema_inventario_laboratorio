<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">📋 Historial de Auditoría</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="mb-4">
            <a href="{{ route('users.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                ← Volver a Usuarios
            </a>
        </div>

        @forelse($logs as $log)
            <div class="bg-white p-4 rounded shadow border">
                <p><strong>👤 Usuario:</strong> {{ $log->usuario->name ?? 'Sistema' }}</p>
                <p><strong>🕒 Fecha:</strong> {{ $log->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>⚙️ Acción:</strong> {{ ucfirst($log->accion) }}</p>
                <p><strong>📌 Modelo afectado:</strong> {{ $log->modelo_afectado }} #{{ $log->modelo_id }}</p>
                <p><strong>📝 Descripción:</strong> {{ $log->descripcion }}</p>

                @if($log->datos_anteriores)
                    <details class="mt-2">
                        <summary class="cursor-pointer text-sm text-gray-600">📂 Datos anteriores</summary>
                        <pre class="bg-gray-100 p-2 text-sm rounded overflow-x-auto">
                        {{ json_encode($log->datos_anteriores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        </pre>
                    </details>
                @endif

                @if($log->datos_nuevos)
                    <details class="mt-2">
                        <summary class="cursor-pointer text-sm text-gray-600">📁 Datos nuevos</summary>
                        <pre class="bg-gray-100 p-2 text-sm rounded overflow-x-auto">
                        {{ json_encode($log->datos_nuevos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        </pre>
                    </details>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No hay registros aún.</p>
        @endforelse

        <div class="mt-6">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
