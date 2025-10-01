<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaGenerada;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StockLowNotification;

class AlertaController extends Controller
{
    //Mostrar todas las alertas.
    public function index()
    {
        // Trae todas las alertas con su ítem relacionado
        $alertas = Alerta::with('item')->latest()->get();

        return view('alertas.index', compact('alertas'));
    }

    //Guardar una nueva alerta.
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $alerta = Alerta::create([
            'item_id' => $request->item_id,
            'cantidad' => $request->cantidad,
            'estado' => 'pendiente',
        ]);

        // Notificación siempre al mismo correo
        Notification::route('mail', 'alertas.lab.pb@gmail.com')
            ->notify(new StockLowNotification($alerta->item->nombre, $alerta->cantidad));

        return redirect()->route('alertas.index')->with('success', '✅ Alerta creada y enviada al correo.');
    }

    //Cambiar el estado de una alerta a "atendida".
    public function atender($id)
    {
        $alerta = Alerta::with('item')->findOrFail($id);
        $alerta->update(['estado' => 'atendida']);

        // Opcional: enviar correo notificando que se atendió
        // Mail::to('alertas.lab.pb@gmail.com')->send(new AlertaAtendida($alerta));

        return redirect()->route('alertas.index')->with('success', '🔔 La alerta fue marcada como atendida.');
    }

    //Eliminar una alerta.
    public function destroy($id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return redirect()->route('alertas.index')->with('success', '🗑️ Alerta eliminada.');
    }

    public function estadisticas()
    {
        // Total de alertas
        $total = Alerta::count();

        // Alertas pendientes
        $pendientes = Alerta::where('estado', 'pendiente')->count();

        // Alertas atendidas
        $atendidas = Alerta::where('estado', 'atendida')->count();

        // Porcentajes
        $porcentajePendientes = $total > 0 ? ($pendientes / $total) * 100 : 0;
        $porcentajeAtendidas = $total > 0 ? ($atendidas / $total) * 100 : 0;

        return view('alertas.estadisticas', compact(
            'total', 'pendientes', 'atendidas', 'porcentajePendientes', 'porcentajeAtendidas'
        ));
    }
}
