<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Página de inicio
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard por rol (redirección automática)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user()?->load('roles');

    if (!$user) {
        return redirect()->route('login');
    }

    // Si tiene un solo rol → lo mando directo
    if ($user->roles->count() === 1) {
        $role = $user->roles->first()->name;

        return match ($role) {
            'admin'      => redirect()->route('dashboard.admin'),
            'profesor'   => redirect()->route('dashboard.profesor'),
            'estudiante' => redirect()->route('dashboard.estudiante'),
            default      => redirect()->route('dashboard.selector'),
        };
    }

    // Si tiene más de un rol → selector
    return redirect()->route('dashboard.selector');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (cualquier usuario logueado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |-------------------------
    | 👤 Perfil
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-------------------------
    | 📊 Dashboards
    |-------------------------
    */
    Route::get('/admin/dashboard', [ItemController::class, 'adminDashboard'])->name('dashboard.admin');

    Route::get('/profesor/dashboard', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        $reservas = \App\Models\Reserva::with('item')
            ->where('user_id', auth()->id())
            ->get();

        return view('profesor.dashboard', compact('items', 'reservas'));
    })->name('dashboard.profesor');

    Route::get('/estudiante/dashboard', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        $reservas = \App\Models\Reserva::with('item')
            ->where('user_id', auth()->id())
            ->get();

        return view('estudiante.dashboard', compact('items', 'reservas'));
    })->name('dashboard.estudiante');

    /*
    |-------------------------
    | 📌 Reservas
    |-------------------------
    */
    Route::get('/reservas/estudiante', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        return view('reservas.estudiante', compact('items'));
    })->name('reservas.estudiante');

    Route::get('/reservas/profesor', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        return view('reservas.docente', compact('items'));
    })->name('reservas.profesor');

    // Crear reservas
    Route::post('/items/{item}/reservar', [ReservaController::class, 'store'])->name('reservas.store'); // estudiante
    Route::post('/items-profesor/{item}/reservar', [ReservaController::class, 'storeDocente'])->name('reservas.profesor_store'); // profesor

    // Mis reservas
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('reservas.mis_reservas');
    Route::delete('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
    Route::patch('/reservas/{reserva}/devolver', [ReservaController::class, 'devolver'])->name('reservas.devolver');

    /*
    |-------------------------
    | 📦 Items
    |-------------------------
    */
    Route::resource('items', ItemController::class);
    Route::get('/items/{item}/edit-stock', [ItemController::class, 'editStock'])->name('items.editStock');
    Route::post('/items/{item}/update-stock', [ItemController::class, 'updateStock'])->name('items.updateStock');

    /*
    |-------------------------
    | 🛠️ Reservas gestionadas por Admin
    |-------------------------
    */
    Route::get('/admin/reservas', [ReservaController::class, 'index'])->name('admin.reservas.index');
    Route::patch('/admin/reservas/{reserva}/aprobar', [ReservaController::class, 'aprobar'])->name('admin.reservas.aprobar');
    Route::patch('/admin/reservas/{reserva}/rechazar', [ReservaController::class, 'rechazar'])->name('admin.reservas.rechazar');

    /*
    |-------------------------
    | 🔀 Selector de rol
    |-------------------------
    */
    Route::get('/seleccionar-rol', function () {
        $user = Auth::user()->load('roles');
        return view('auth.seleccionar-rol', compact('user'));
    })->name('dashboard.selector');

    Route::post('/seleccionar-rol', function (Request $request) {
        $request->validate([
            'role' => 'required|in:admin,profesor,estudiante',
        ]);

        session(['selected_role' => $request->role]);

        return match ($request->role) {
            'admin'      => redirect()->route('dashboard.admin'),
            'profesor'   => redirect()->route('dashboard.profesor'),
            'estudiante' => redirect()->route('dashboard.estudiante'),
            default      => redirect()->route('dashboard'),
        };
    })->name('dashboard.selector.submit');

    Route::get('/cambiar-rol', function () {
        session()->forget('selected_role');
        return redirect()->route('dashboard.selector');
    })->name('cambiar-rol');
});

/*
|--------------------------------------------------------------------------
| 👑 Admin gestiona usuarios
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('users', UserController::class);
});


require __DIR__.'/auth.php';
