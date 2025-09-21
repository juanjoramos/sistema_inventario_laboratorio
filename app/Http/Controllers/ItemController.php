<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaccion;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //Mostrar lista completa de ítems (para admins).
    public function index()
    {
        $items = Item::with('transacciones')->get();
        return view('items.index', compact('items'));
    }

    //Mostrar formulario para crear un nuevo ítem (admin).
    public function create()
    {
        return view('items.create');
    }

    //Almacenar un nuevo ítem y registrar transacción inicial (admin).
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:255',
            'codigo'            => 'required|string|max:50|unique:items',
            'categoria' => 'required|in:Equipos,Reactivos,Materiales',
            'cantidad'          => 'required|integer|min:0',
            'ubicacion'         => 'nullable|string|max:255',
            'proveedor'         => 'nullable|string|max:255',
            'fecha_vencimiento' => 'nullable|date',
            'umbral_minimo'     => 'required|integer|min:0',
        ]);

        $item = Item::create($validated);

        // Registrar transacción inicial
        Transaccion::create([
            'item_id'     => $item->id,
            'tipo'        => 'entrada',
            'cantidad'    => $item->cantidad,
            'descripcion' => 'Registro inicial de stock',
        ]);

        return redirect()->route('items.index')->with('success', 'Ítem creado correctamente.');
    }

    //Mostrar detalles de un ítem (admin).
    public function show(Item $item)
    {
        $item->load(['transacciones', 'reservas.user']);
        return view('items.show', compact('item'));
    }

    //Mostrar formulario para editar un ítem (admin).
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    //Actualizar un ítem existente y registrar cambios de stock (admin).
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:255',
            'codigo'            => 'required|string|max:50|unique:items,codigo,' . $item->id,
            'categoria'         => 'required|in:Equipos,Reactivos,Materiales',
            'cantidad'          => 'required|integer|min:0',
            'ubicacion'         => 'nullable|string|max:255',
            'proveedor'         => 'nullable|string|max:255',
            'fecha_vencimiento' => 'nullable|date',
            'umbral_minimo'     => 'required|integer|min:0',
        ]);

        // Registrar transacción si cambió la cantidad
        if ($validated['cantidad'] != $item->cantidad) {
            $tipo = $validated['cantidad'] > $item->cantidad ? 'entrada' : 'salida';
            $cantidadCambio = abs($validated['cantidad'] - $item->cantidad);

            Transaccion::create([
                'item_id'     => $item->id,
                'tipo'        => $tipo,
                'cantidad'    => $cantidadCambio,
                'descripcion' => 'Actualización manual de stock',
            ]);
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Ítem actualizado correctamente.');
    }

    //Eliminar un ítem del inventario (admin).
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Ítem eliminado correctamente.');
    }

    //Mostrar dashboard del administrador con ítems de bajo stock.
    public function adminDashboard()
    {
        $items = Item::whereColumn('cantidad', '<=', 'umbral_minimo')->get();
        return view('admin.dashboard', compact('items'));
    }

    //Vista para estudiantes: muestra ítems disponibles.
    public function studentIndex()
    {
        $items = Item::where('cantidad', '>', 0)->get();
        return view('items.student_index', compact('items'));
    }

    //Vista para docentes: muestra ítems disponibles.
    public function docenteIndex()
    {
        $items = Item::all();
        return view('items.docente_index', compact('items'));
    }

    //Mostrar formulario para actualizar stock (entrada/salida)
    public function editStock(Item $item)
    {
        return view('items.update_stock', compact('item'));
    }

    //Actualizar cantidad de stock (entradas o salidas) y registrar transacción.
    public function updateStock(Request $request, Item $item)
    {
        $validated = $request->validate([
            'tipo'        => 'required|in:entrada,salida',
            'cantidad'    => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:500',
        ]);

        if ($validated['tipo'] === 'salida' && $validated['cantidad'] > $item->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.']);
        }

        // Actualizar cantidad según tipo
        if ($validated['tipo'] === 'entrada') {
            $item->cantidad += $validated['cantidad'];
        } else {
            $item->cantidad -= $validated['cantidad'];
        }

        $item->save();

        // Registrar transacción
        Transaccion::create([
            'item_id'     => $item->id,
            'tipo'        => $validated['tipo'],
            'cantidad'    => $validated['cantidad'],
            'descripcion' => $validated['descripcion'] ?? ($validated['tipo'] === 'entrada' ? 'Entrada de stock' : 'Salida de stock'),
        ]);

        // Verificar si stock está por debajo del umbral y disparar alerta (aquí puedes personalizar la lógica)
        if ($item->cantidad <= $item->umbral_minimo) {
            \Log::warning("Alerta: El stock del ítem '{$item->nombre}' (Código: {$item->codigo}) está en o por debajo del umbral mínimo: {$item->cantidad}");
            // Aquí podrías agregar notificaciones por email, etc.
        }

        return redirect()->route('items.show', $item)->with('success', 'Stock actualizado correctamente.');
    }

    public function reservar(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        if ($item->cantidad <= 0) {
            return redirect()->back()->with('error', 'No hay stock disponible para reservar.');
        }

        // Reducir stock
        $item->cantidad -= 1;
        $item->save();

        // Registrar transacción de salida (tipo reserva)
        Transaccion::create([
            'item_id'     => $item->id,
            'tipo'        => 'reserva',
            'cantidad'    => 1,
            'descripcion' => 'Reserva realizada por usuario',
        ]);

        return redirect()->back()->with('success', 'Reserva realizada correctamente.');
    }

}
