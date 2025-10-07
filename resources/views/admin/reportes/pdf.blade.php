<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Reporte {{ ucfirst($tipo) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fbff;
            color: #2c3e50;
            margin: 40px auto;
            max-width: 700px;
            padding: 30px 35px;
            line-height: 1.5;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            font-size: 2.4rem;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        h1 span {
            display: block;
            font-weight: normal;
            font-size: 1.1rem;
            color: #4f6fad;
            margin-top: 6px;
        }

        .periodo {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1rem;
            color: #3b5998;
        }

        strong {
            color: #1e40af;
        }

        h3 {
            font-weight: bold;
            font-size: 1.4rem;
            color: #1e40af;
            border-bottom: 2px solid #93c5fd;
            padding-bottom: 6px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin: 0 0 30px 0;
        }

        ul li {
            background-color: #e0e7ff;
            margin-bottom: 10px;
            padding: 14px 20px;
            border-radius: 10px;
            color: #1e40af;
            font-weight: 600;
            box-shadow: 1px 2px 6px rgba(30, 64, 175, 0.15);
        }

        .tendencias {
            background-color: #f0f5ff;
            padding: 20px 25px;
            border-radius: 10px;
            color: #374785;
            font-size: 1.1rem;
            box-shadow: inset 0 0 10px #a3c4f3;
            font-weight: 400;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #7b8db8;
            font-style: italic;
            border-top: 1px solid #dbeafe;
            padding-top: 18px;
            user-select: none;
        }

        @media (max-width: 480px) {
            body {
                padding: 25px 20px;
                margin: 30px auto;
            }

            h1 {
                font-size: 1.9rem;
            }

            h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <h1>
        Reporte de {{ ucwords(str_replace('_', ' ', strtolower($tipo))) }}
        <span>Estadísticas claras y frescas</span>
    </h1>

    <div class="periodo">
        <p><strong>Periodo:</strong> {{ ucfirst($periodo) }}</p>
        <p><strong>Desde:</strong> {{ $estadisticas['fecha_inicio'] }} | <strong>Hasta:</strong> {{ $estadisticas['fecha_fin'] }}</p>
    </div>

    <section>
        <h3>Items más usados</h3>
        <ul>
            @forelse ($estadisticas['items_mas_usados'] as $item)
                <li>{{ $item }}</li>
            @empty
                <li>No hay datos registrados en este periodo.</li>
            @endforelse
        </ul>
    </section>

    @if (!empty($estadisticas['frecuencia_reabastecimiento']) && is_array($estadisticas['frecuencia_reabastecimiento']))
        <section>
            <h3>Frecuencia de Reabastecimiento</h3>
            <ul>
                @foreach ($estadisticas['frecuencia_reabastecimiento'] as $item => $frecuencia)
                    <li>{{ $item }} — {{ ucfirst($frecuencia) }}</li>
                @endforeach
            </ul>
        </section>
    @endif

<section>
    <h3>Tendencias</h3>

    @php
        // Asegurarse de que es una colección o array
        $tendencias = is_string($estadisticas['tendencias_consumo'])
            ? json_decode($estadisticas['tendencias_consumo'], true)
            : $estadisticas['tendencias_consumo'];
    @endphp

    @if (empty($tendencias) || count($tendencias) === 0)
        <p class="tendencias">No hay datos de consumo para este periodo.</p>
    @else
        <ul>
            @foreach ($tendencias as $registro)
                <li>
                    @if($periodo === 'diario')
                        Fecha: {{ $registro['fecha'] ?? $registro->fecha ?? '-' }}
                    @elseif($periodo === 'semanal')
                        Año: {{ $registro['anio'] ?? $registro->anio ?? '-' }} - Semana: {{ $registro['semana'] ?? $registro->semana ?? '-' }}
                    @elseif($periodo === 'mensual')
                        Mes: {{ $registro['mes'] ?? $registro->mes ?? '-' }}
                    @endif
                    — Cantidad consumida: <strong>{{ $registro['total_consumido'] ?? $registro->total_consumido ?? '0' }}</strong>
                </li>
            @endforeach
        </ul>
    @endif
</section>


    <div class="footer">
        <p>Generado automáticamente el {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
