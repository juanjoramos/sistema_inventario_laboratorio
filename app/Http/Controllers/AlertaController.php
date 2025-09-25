<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

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

        Alerta::create([
            'item_id' => $request->item_id,
            'cantidad' => $request->cantidad,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('alertas.index')->with('success', '✅ Alerta creada correctamente.');
    }

    //Cambiar el estado de una alerta a "atendida".
    public function atender($id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->update(['estado' => 'atendida']);

        return redirect()->route('alertas.index')->with('success', '🔔 La alerta fue marcada como atendida.');
    }

    //Eliminar una alerta
    public function destroy($id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return redirect()->route('alertas.index')->with('success', '🗑️ Alerta eliminada.');
    }
}