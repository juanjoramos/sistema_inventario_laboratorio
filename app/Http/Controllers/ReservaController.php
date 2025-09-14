<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Estudiante reserva (solo 1 unidad por ítem).
     */
    public function store(Item $item)
    {
        if ($item->cantidad <= 0) {
            return back()->with('error', 'No hay stock disponible.');
        }

        // Verificar si el estudiante ya reservó este ítem
            $existe = Reserva::where('item_id', $item->id)
                 ->where('user_id', Auth::id())
                 ->where('estado', '!=', 'cancelado') // ✅ ignora canceladas
                 ->first();

        if ($existe) {
            return back()->with('error', 'Solo puedes tener una reserva activa por ítem, incluso si cambias de rol.');
        }

        // Crear la reserva
        Reserva::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'cantidad' => 1,
            'estado' => 'pendiente',
        ]);

        // Reducir stock
        $item->decrement('cantidad', 1);

        return back()->with('success', 'Has reservado el ítem.');
    }

    /**
     * Profesor reserva (puede elegir cantidad).
     */
    public function storeDocente(Request $request, Item $item)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        if ($item->cantidad < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        Reserva::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'cantidad' => $request->cantidad,
            'estado' => 'pendiente',
        ]);

        // Reducir stock
        $item->decrement('cantidad', $request->cantidad);

        return back()->with('success', 'Reserva realizada correctamente.');
    }

    /**
     * Listar reservas del usuario (opcional).
     */
    public function misReservas()
    {
        $reservas = Reserva::with('item')
            ->where('user_id', Auth::id())
            ->get();

        return view('reservas.mis_reservas', compact('reservas'));
    }

    /**
     * Cancelar una reserva (opcional).
     */
    public function cancelar(Reserva $reserva)
    {
        if ($reserva->user_id !== Auth::id()) {
            return back()->with('error', 'No puedes cancelar esta reserva.');
        }

        // Devolver stock
        $reserva->item->increment('cantidad', $reserva->cantidad);

        $reserva->delete();

        return back()->with('success', 'Reserva cancelada correctamente.');
    }

    public function aprobar(Reserva $reserva)
    {
        $reserva->update(['estado' => 'entregado']);
        return back()->with('success', 'Reserva marcada como entregada.');
    }

    public function rechazar(Reserva $reserva)
    {
        // Solo devolver stock si aún no estaba cancelado ni entregado
        if ($reserva->estado === 'pendiente') {
            $reserva->item->increment('cantidad', $reserva->cantidad);
        }

        $reserva->update(['estado' => 'cancelado']);

        return back()->with('success', 'Reserva cancelada y stock restaurado.');
    }


    public function index()
    {
        // Solo admins deberían ver esto (protección adicional opcional)
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado.');
        }

        $reservas = Reserva::with(['user', 'item'])->latest()->get();

        return view('reservas.index', compact('reservas'));
    }

}
