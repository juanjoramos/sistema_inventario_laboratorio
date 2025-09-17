<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Reserva;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * 📌 Estudiante: reserva 1 unidad fija.
     */
    public function store(Request $request, Item $item)
    {
        // Validar datos
        $request->validate([
            'fecha_devolucion_prevista' => 'required|date|after:today',
            'motivo' => 'required|string|max:255',
        ], [
            'fecha_devolucion_prevista.required' => '⚠️ Debes seleccionar una fecha de devolución.',
            'fecha_devolucion_prevista.date' => '⚠️ La fecha ingresada no es válida.',
            'fecha_devolucion_prevista.after' => '⚠️ La fecha de devolución debe ser posterior a hoy.',
            'motivo.required' => '⚠️ Debes indicar un motivo para la reserva.',
            'motivo.string' => '⚠️ El motivo debe ser un texto válido.',
            'motivo.max' => '⚠️ El motivo no puede superar los 255 caracteres.',
        ]);

        // Validar stock
        if ($item->cantidad <= 0) {
            return redirect()->back()->withErrors(['stock' => '❌ No hay stock disponible para este ítem.']);
        }

        // Validar si ya tiene una reserva activa
        $existe = Reserva::where('item_id', $item->id)
            ->where('user_id', Auth::id())
            ->whereIn('estado', ['pendiente', 'entregado'])
            ->first();

        if ($existe) {
            return redirect()->back()->withErrors(['reserva' => '⚠️ Ya tienes una reserva activa de este ítem.']);
        }

        // Crear reserva
        Reserva::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'cantidad' => 1,
            'estado' => 'pendiente',
            'fecha_prestamo' => now(),
            'fecha_devolucion_prevista' => $request->fecha_devolucion_prevista,
            'motivo' => $request->motivo,
        ]);

        // Actualizar stock
        $item->decrement('cantidad', 1);

        // Registrar transacción
        Transaccion::create([
            'item_id' => $item->id,
            'tipo' => 'salida',
            'cantidad' => 1,
            'descripcion' => 'Préstamo por usuario ID ' . Auth::id(),
        ]);

        return redirect()->back()->with('success', '✅ Tu solicitud de préstamo fue registrada y está pendiente de aprobación.');
    }

    /**
     * 📌 Profesor: puede elegir cantidad.
     */
    public function storeDocente(Request $request, Item $item)
{
    // Validar datos
    $request->validate([
        'cantidad' => 'required|integer|min:1',
        'fecha_devolucion_prevista' => 'required|date|after:today',
        'motivo' => 'required|string|max:255',
    ], [
        'cantidad.required' => '⚠️ Debes indicar la cantidad a reservar.',
        'cantidad.integer' => '⚠️ La cantidad debe ser un número entero.',
        'cantidad.min' => '⚠️ La cantidad mínima es 1.',
        'fecha_devolucion_prevista.required' => '⚠️ Debes seleccionar una fecha de devolución.',
        'fecha_devolucion_prevista.date' => '⚠️ La fecha ingresada no es válida.',
        'fecha_devolucion_prevista.after' => '⚠️ La fecha de devolución debe ser posterior a hoy.',
        'motivo.required' => '⚠️ Debes indicar un motivo para la reserva.',
        'motivo.string' => '⚠️ El motivo debe ser un texto válido.',
        'motivo.max' => '⚠️ El motivo no puede superar los 255 caracteres.',
    ]);

    // Validar stock
    if ($item->cantidad < $request->cantidad) {
        return redirect()->back()->withErrors(['stock' => '❌ No hay suficiente stock disponible.'])->withInput();
    }

    // Crear reserva
    Reserva::create([
        'item_id' => $item->id,
        'user_id' => Auth::id(),
        'cantidad' => $request->cantidad,
        'estado' => 'pendiente',
        'fecha_prestamo' => now(),
        'fecha_devolucion_prevista' => $request->fecha_devolucion_prevista,
        'motivo' => $request->motivo,
    ]);

    // Actualizar stock
    $item->decrement('cantidad', $request->cantidad);

    // Registrar transacción
    Transaccion::create([
        'item_id' => $item->id,
        'tipo' => 'salida',
        'cantidad' => $request->cantidad,
        'descripcion' => 'Préstamo por usuario ID ' . Auth::id(),
    ]);

    return redirect()->back()->with('success', ' Tu solicitud de préstamo fue registrada y está pendiente de aprobación.');
}
    /**
     * 📌 Ver reservas del usuario autenticado (profesor o estudiante).
     */
    public function misReservas()
    {
        $reservas = Reserva::with('item')
            ->where('user_id', Auth::id())
            ->get();

        return view('reservas.mis_reservas', compact('reservas'));
    }

    /**
     * 📌 Cancelar reserva (solo el dueño).
     */
    public function cancelar(Reserva $reserva)
    {
        if ($reserva->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['auth' => '❌ No puedes cancelar esta reserva.']);
        }

        $reserva->item->increment('cantidad', $reserva->cantidad);
        $reserva->update(['estado' => 'cancelado']);

        return redirect()->back()->with('success', '✅ Reserva cancelada correctamente.');
    }

    /**
     * 📌 Admin: aprobar (marcar como entregada).
     */
    public function aprobar(Reserva $reserva)
    {
        $reserva->update(['estado' => 'entregado']);
        return redirect()->back()->with('success', '✅ Reserva marcada como entregada.');
    }

    /**
     * 📌 Admin: rechazar y restaurar stock.
     */
    public function rechazar(Reserva $reserva)
    {
        if ($reserva->estado === 'pendiente') {
            $reserva->item->increment('cantidad', $reserva->cantidad);
        }

        $reserva->update(['estado' => 'cancelado']);
        return redirect()->back()->with('success', '❌ Reserva cancelada y stock restaurado.');
    }

    /**
     * 📌 Admin: ver todas las reservas.
     */
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado.');
        }

        $reservas = Reserva::with(['user', 'item'])->latest()->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * 📌 Usuario (profesor o estudiante) devuelve el ítem.
     */
    public function devolver(Reserva $reserva)
    {
        if ($reserva->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['auth' => '❌ No puedes devolver una reserva que no es tuya.']);
        }

        if ($reserva->estado !== 'entregado') {
            return redirect()->back()->withErrors(['estado' => '⚠️ Solo se pueden devolver reservas que ya fueron entregadas.']);
        }

        // Restaurar stock
        $reserva->item->increment('cantidad', $reserva->cantidad);

        // Cambiar estado
        $reserva->update(['estado' => 'devuelto']);

        return redirect()->back()->with('success', '✅ Has devuelto el ítem correctamente.');
    }

}
