<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Reserva;
use App\Models\Transaccion;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function formulario()
    {
        return view('admin.reportes.formulario');
    }

    public function generar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:stock,prestamos,consumo_reactivos,equipos_usados',
            'periodo' => 'required|in:diario,semanal,mensual',
        ]);

        $estadisticas = $this->obtenerEstadisticas($request->tipo, $request->periodo);

        return view('admin.reportes.resultado', [
            'tipo' => $request->tipo,
            'periodo' => $request->periodo,
            'fecha' => now(),
            'estadisticas' => $estadisticas,
        ]);
    }

    private function obtenerEstadisticas($tipo, $periodo)
    {
        $fechaFin = now()->endOfDay();
        $fechaInicio = match ($periodo) {
            'diario' => now()->startOfDay(),
            'semanal' => now()->subWeek()->startOfDay(),
            'mensual' => now()->subMonth()->startOfDay(),
        };

        switch ($tipo) {
            /* -------------------- STOCK -------------------- */
            case 'stock':
                $tendencias_consumo = $this->obtenerTendenciasConsumo($fechaInicio, $fechaFin, $periodo);
                if ($periodo === 'semanal') {
                    foreach ($tendencias_consumo as &$registro) {
                        $inicioSemana = Carbon::now()->setISODate($registro->anio, $registro->semana)->startOfWeek();
                        $finSemana = Carbon::now()->setISODate($registro->anio, $registro->semana)->endOfWeek();
                        $registro->rango_fechas = $inicioSemana->format('d-m-Y') . ' - ' . $finSemana->format('d-m-Y');
                    }
                }
                return [
                    'items_mas_usados' => Item::orderBy('cantidad', 'asc')->limit(5)->pluck('nombre'),
                    'frecuencia_reabastecimiento' => $this->frecuenciaReabastecimiento(),
                    'tendencias_consumo' => $tendencias_consumo,
                    'fecha_inicio' => $fechaInicio->format('d-m-Y'),
                    'fecha_fin' => $fechaFin->format('d-m-Y'),
                ];

            /* -------------------- PRÉSTAMOS -------------------- */
            case 'prestamos':
                $prestamos = Reserva::whereBetween('created_at', [$fechaInicio, $fechaFin])
                    ->whereIn('estado', ['prestado', 'devuelto'])
                    ->with('item')
                    ->get();

                $itemsMasUsados = $prestamos->groupBy('item_id')
                    ->sortByDesc(fn($grupo) => $grupo->count())
                    ->take(5)
                    ->map(function ($grupo) {
                        $item = $grupo->first()->item;
                        $cantidad = $grupo->count();
                        return $item ? "{$item->nombre} ({$cantidad} préstamo(s))" : "Desconocido ({$cantidad})";
                    });

                $tendencias = $this->obtenerTendenciasConsumo($fechaInicio, $fechaFin, $periodo);

                return [
                    'items_mas_usados' => $itemsMasUsados->values(),
                    'frecuencia_reabastecimiento' => [],
                    'tendencias_consumo' => $this->describirTendencias($tendencias),
                    'fecha_inicio' => $fechaInicio->format('d-m-Y'),
                    'fecha_fin' => $fechaFin->format('d-m-Y'),
                ];

            /* -------------------- CONSUMO REACTIVOS -------------------- */
            case 'consumo_reactivos':
                $consumos = Reserva::whereBetween('created_at', [$fechaInicio, $fechaFin])
                    ->with('item')
                    ->get()
                    ->filter(fn($r) => $r->item && str_contains(strtolower($r->item->categoria), 'reactivo'))
                    ->groupBy('item_id')
                    ->sortByDesc(fn($g) => $g->count())
                    ->take(5)
                    ->map(fn($g) => $g->first()->item->nombre);

                $tendencias = $this->obtenerTendenciasConsumo($fechaInicio, $fechaFin, $periodo);
                return [
                    'items_mas_usados' => $consumos->values(),
                    'frecuencia_reabastecimiento' => [],
                    'tendencias_consumo' => $this->describirTendencias($tendencias),
                    'fecha_inicio' => $fechaInicio->format('d-m-Y'),
                    'fecha_fin' => $fechaFin->format('d-m-Y'),
                ];

            /* -------------------- EQUIPOS USADOS -------------------- */
            case 'equipos_usados':
                $usos = Reserva::join('items', 'reservas.item_id', '=', 'items.id')
                    ->whereBetween('reservas.created_at', [$fechaInicio, $fechaFin])
                    ->select('items.nombre', DB::raw('COUNT(reservas.id) as total'))
                    ->groupBy('items.nombre')
                    ->orderByDesc('total')
                    ->take(5)
                    ->get()
                    ->map(fn($r) => "{$r->nombre} ({$r->total} uso(s))");

                $tendencias = $this->obtenerTendenciasConsumo($fechaInicio, $fechaFin, $periodo);

                return [
                    'items_mas_usados' => $usos,
                    'frecuencia_reabastecimiento' => [],
                    'tendencias_consumo' => $this->describirTendencias($tendencias),
                    'fecha_inicio' => $fechaInicio->format('d-m-Y'),
                    'fecha_fin' => $fechaFin->format('d-m-Y'),
                ];
        }
    }

    private function frecuenciaReabastecimiento()
    {
        $entradas = Transaccion::where('tipo', 'entrada')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('item_id');

        $frecuencias = [];

        if ($entradas->isEmpty()) {
            foreach (Item::all() as $item) {
                $frecuencias[$item->nombre] = 'Sin datos suficientes';
            }
            return $frecuencias;
        }

        foreach ($entradas as $itemId => $movimientos) {
            if ($movimientos->count() < 2) {
                $frecuencias[Item::find($itemId)?->nombre ?? 'Desconocido'] = 'Sin datos suficientes';
                continue;
            }

            $fechas = $movimientos->pluck('created_at')->take(2);
            $dias = $fechas[0]->diffInDays($fechas[1]);

            $frecuencia = match (true) {
                $dias <= 7 => 'Semanal',
                $dias <= 30 => 'Mensual',
                $dias <= 90 => 'Trimestral',
                default => 'Ocasional',
            };

            $nombreItem = Item::find($itemId)?->nombre ?? 'Desconocido';
            $frecuencias[$nombreItem] = $frecuencia;
        }

        return $frecuencias;
    }

    public function generarConParametros($tipo, $periodo)
    {
        if (!in_array($tipo, ['stock', 'prestamos', 'consumo_reactivos', 'equipos_usados']) ||
            !in_array($periodo, ['diario', 'semanal', 'mensual'])) {
            abort(404, 'Parámetros inválidos');
        }

        $estadisticas = $this->obtenerEstadisticas($tipo, $periodo);

        return view('admin.reportes.resultado', [
            'tipo' => $tipo,
            'periodo' => $periodo,
            'fecha' => now(),
            'estadisticas' => $estadisticas,
        ]);
    }

    public function exportarPDF($tipo, $periodo)
    {
        if (!in_array($tipo, ['stock', 'prestamos', 'consumo_reactivos', 'equipos_usados']) ||
            !in_array($periodo, ['diario', 'semanal', 'mensual'])) {
            abort(404, 'Parámetros inválidos');
        }

        $estadisticas = $this->obtenerEstadisticas($tipo, $periodo);

        $pdf = Pdf::loadView('admin.reportes.pdf', [
            'tipo' => $tipo,
            'periodo' => $periodo,
            'fecha' => now(),
            'estadisticas' => $estadisticas,
        ])->setPaper('a4', 'portrait');

        return $pdf->download("Reporte_{$tipo}_{$periodo}.pdf");
    }

    private function obtenerTendenciasConsumo($fechaInicio, $fechaFin, $periodo)
    {
        $query = Transaccion::where('tipo', 'salida')
            ->whereBetween('created_at', [$fechaInicio, $fechaFin]);

        switch ($periodo) {
            case 'diario':
                $query->select(
                    DB::raw('DATE(created_at) as fecha'),
                    DB::raw('SUM(cantidad) as total_consumido')
                )
                ->groupBy('fecha')
                ->orderBy('fecha');
                break;

            case 'semanal':
                $query->select(
                    DB::raw("to_char(created_at, 'IYYY')::int AS anio"),
                    DB::raw("to_char(created_at, 'IW')::int AS semana"),
                    DB::raw('SUM(cantidad) as total_consumido')
                )
                ->groupBy('anio', 'semana')
                ->orderBy('anio')
                ->orderBy('semana');
                break;

            case 'mensual':
                $query->select(
                    DB::raw("to_char(created_at, 'YYYY-MM') as mes"),
                    DB::raw('SUM(cantidad) as total_consumido')
                )
                ->groupBy('mes')
                ->orderBy('mes');
                break;
        }

        return $query->get();
    }

    private function describirTendencias($tendencias)
    {
        if ($tendencias->isEmpty()) {
            return 'No hay datos de consumo para este periodo.';
        }

        $total = $tendencias->sum('total_consumido');

        return match (true) {
            $total < 10 => 'Consumo muy bajo registrado.',
            $total < 50 => 'Consumo moderado durante el periodo.',
            default => 'Alta demanda observada.',
        };
    }
}