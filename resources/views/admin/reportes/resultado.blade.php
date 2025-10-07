<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight flex items-center gap-2">
            <span>📄</span> Resultado del Reporte:
            <span class="text-blue-600 dark:text-blue-400">{{ strtoupper($tipo) }}</span>
        </h2>
    </x-slot>

    <div class="flex justify-center py-8">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">

            <!-- Información del periodo -->
            <div class="mb-4 text-gray-700 dark:text-gray-300 text-sm">
                <p><strong>📆 Periodo:</strong> {{ ucfirst($periodo) }}</p>
                <p>
                    <strong>🗓️ Desde:</strong> {{ $estadisticas['fecha_inicio'] }} |
                    <strong>Hasta:</strong> {{ $estadisticas['fecha_fin'] }}
                </p>
            </div>

            <hr class="my-4 border-gray-300 dark:border-gray-700">

            <!-- Contenido según tipo -->
            @if ($tipo === 'stock')
                <h3 class="mt-4 font-bold text-lg text-blue-600 dark:text-blue-400">📦 Niveles de Stock Actual</h3>
                <ul class="list-disc ml-6 mt-2 space-y-1 text-gray-800 dark:text-gray-200">
                    @forelse ($estadisticas['items_mas_usados'] as $item)
                        <li>{{ $item }}</li>
                    @empty
                        <li>No hay datos registrados.</li>
                    @endforelse
                </ul>

                <h4 class="mt-5 font-semibold text-blue-500 dark:text-blue-400">📅 Frecuencia de Reabastecimiento:</h4>
                <ul class="list-disc ml-6 mt-2 space-y-1 text-gray-700 dark:text-gray-300">
                    @foreach ($estadisticas['frecuencia_reabastecimiento'] as $nombre => $frecuencia)
                        <li>{{ $nombre }} — {{ $frecuencia }}</li>
                    @endforeach
                </ul>

            @elseif ($tipo === 'prestamos')
                <h3 class="mt-4 font-bold text-lg text-indigo-600 dark:text-indigo-400">📚 Ítems más prestados</h3>
                <div class="overflow-x-auto mt-3">
                    <table class="w-full border-collapse text-sm text-gray-800 dark:text-gray-200">
                        <thead class="bg-indigo-100 dark:bg-gray-800 text-indigo-800 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Ítem</th>
                                <th class="px-4 py-2 text-center">Cantidad de préstamos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($estadisticas['items_mas_usados'] as $item)
                                @php preg_match('/^(.*)\s*\((\d+)\spréstamo/', $item, $matches); @endphp
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2">{{ $matches[1] ?? $item }}</td>
                                    <td class="px-4 py-2 text-center">{{ $matches[2] ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center py-3">No hay datos registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            @elseif ($tipo === 'consumo_reactivos')
                <h3 class="mt-4 font-bold text-lg text-green-600 dark:text-green-400">🧪 Reactivos más utilizados</h3>
                <ul class="list-disc ml-6 mt-2 space-y-1 text-gray-800 dark:text-gray-200">
                    @forelse ($estadisticas['items_mas_usados'] as $item)
                        <li>{{ $item }}</li>
                    @empty
                        <li>No hay datos registrados en este periodo.</li>
                    @endforelse
                </ul>

            @elseif ($tipo === 'equipos_usados')
                <h3 class="mt-4 font-bold text-lg text-yellow-600 dark:text-yellow-400">⚙️ Equipos más usados</h3>
                <div class="overflow-x-auto mt-3">
                    <table class="w-full border-collapse text-sm text-gray-800 dark:text-gray-200">
                        <thead class="bg-yellow-100 dark:bg-gray-800 text-yellow-800 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Equipo</th>
                                <th class="px-4 py-2 text-center">Veces usado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($estadisticas['items_mas_usados'] as $item)
                                @php preg_match('/^(.*)\s*\((\d+)/', $item, $matches); @endphp
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2">{{ $matches[1] ?? $item }}</td>
                                    <td class="px-4 py-2 text-center">{{ $matches[2] ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center py-3">No hay datos registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Tendencias -->
                <div class="mt-6 bg-gray-100 dark:bg-gray-800 rounded-xl p-4">
                    <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📈 Tendencias de Consumo</p>

                    @php
                        // Obtener la variable y asegurarnos que sea un iterable (array o colección)
                        $tendencias = $estadisticas['tendencias_consumo'];

                        // Si es string, intentar decodificar JSON a array
                        if (is_string($tendencias)) {
                            $tendencias = json_decode($tendencias);

                            // Si falla la decodificación, dejarlo como array vacío para evitar errores
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                $tendencias = [];
                            }
                        }
                    @endphp

                    @if (collect($tendencias)->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400 text-sm">No hay datos de consumo para este periodo.</p>
                    @else
                        @php
                            $labels = [];
                            $datos = [];
                            foreach ($tendencias as $registro) {
                                if ($periodo === 'diario') {
                                    $labels[] = $registro->fecha ?? '';
                                } elseif ($periodo === 'semanal') {
                                    $labels[] = "Año {$registro->anio} - Semana {$registro->semana}";
                                } elseif ($periodo === 'mensual') {
                                    $labels[] = $registro->mes ?? '';
                                }
                                $datos[] = $registro->total_consumido ?? 0;
                            }
                        @endphp

        <!-- Tabla de tendencias -->
<div class="overflow-x-auto mb-6">
    <table class="w-full text-sm text-gray-800 dark:text-gray-200 border-collapse">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                @if($periodo === 'diario')
                    <th class="px-3 py-2 text-left">Fecha</th>
                @elseif($periodo === 'semanal')
                    <th class="px-3 py-2 text-left">Rango de fechas</th>
                @elseif($periodo === 'mensual')
                    <th class="px-3 py-2 text-left">Mes</th>
                @endif
                <th class="px-3 py-2 text-right">Cantidad consumida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tendencias as $registro)
                <tr class="border-b border-gray-300 dark:border-gray-700">
                    @if($periodo === 'diario')
                        <td class="px-3 py-1">{{ $registro->fecha ?? '-' }}</td>
                    @elseif($periodo === 'semanal')
                        <td class="px-3 py-1">{{ $registro->rango_fechas ?? "Semana {$registro->semana} - Año {$registro->anio}" }}</td>
                    @elseif($periodo === 'mensual')
                        <td class="px-3 py-1">{{ $registro->mes ?? '-' }}</td>
                    @endif
                    <td class="px-3 py-1 text-right font-semibold">{{ $registro->total_consumido ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Gráfico de tendencias -->
<canvas id="graficoTendencias" height="150"></canvas>
@endif
</div>


            <!-- Botón de descarga -->
            <div class="mt-8 text-center">
                <a href="{{ route('admin.reportes.pdf', ['tipo' => $tipo, 'periodo' => $periodo]) }}"
                   class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-6 py-2.5 rounded-full shadow-md transition-transform transform hover:scale-105">
                    📄 Descargar PDF
                </a>
            </div>

        </div>
    </div>

@if(is_array($estadisticas['tendencias_consumo']) && count($estadisticas['tendencias_consumo']) > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById('graficoTendencias').getContext('2d');

                const etiquetas = @json($labels);
                const datosConsumo = @json($datos);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: etiquetas,
                        datasets: [{
                            label: 'Consumo',
                            data: datosConsumo,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.3)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true },
                            tooltip: { enabled: true }
                        },
                        scales: {
                            x: { display: true, title: { display: true, text: 'Periodo' } },
                            y: {
                                display: true,
                                title: { display: true, text: 'Cantidad consumida' },
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</x-app-layout>