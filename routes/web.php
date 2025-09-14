<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirección al Dashboard según rol
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user()?->load('roles');

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->roles->count() === 1) {
        $role = $user->roles->first()->name;

        return match ($role) {
            'admin'      => redirect()->route('dashboard.admin'),
            'profesor'   => redirect()->route('dashboard.profesor'),
            'estudiante' => redirect()->route('dashboard.estudiante'),
            default      => redirect()->route('dashboard.selector'),
        };
    }

    // Usuario con múltiples roles → va al selector
    return redirect()->route('dashboard.selector');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil del Usuario
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Dashboards por Rol
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [ItemController::class, 'adminDashboard'])->name('dashboard.admin');

    Route::get('/profesor/dashboard', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        return view('reservas.docente', compact('items'));
    })->name('dashboard.profesor');

    Route::get('/estudiante/dashboard', function () {
        $items = \App\Models\Item::where('cantidad', '>', 0)->get();
        return view('reservas.estudiante', compact('items'));
    })->name('dashboard.estudiante');

    /*
    |--------------------------------------------------------------------------
    | Selector de Rol (para usuarios con múltiples roles)
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | Cambiar de Rol (opcional)
    |--------------------------------------------------------------------------
    */
    Route::get('/cambiar-rol', function () {
        session()->forget('selected_role');
        return redirect()->route('dashboard.selector');
    })->name('cambiar-rol');

    /*
    |--------------------------------------------------------------------------
    | CRUD de Items (idealmente proteger con middleware de admin)
    |--------------------------------------------------------------------------
    */
    Route::resource('items', ItemController::class);

    /*
    | Rutas para actualizar stock de un ítem
    */
    Route::get('/items/{item}/edit-stock', [ItemController::class, 'editStock'])->name('items.editStock');
    Route::post('/items/{item}/update-stock', [ItemController::class, 'updateStock'])->name('items.updateStock');

    /*
    |--------------------------------------------------------------------------
    | Reservas (Estudiantes y Profesores)
    |--------------------------------------------------------------------------
    */
    // Estudiante (solo 1 por item)
    Route::post('/items/{item}/reservar', [ReservaController::class, 'store'])->name('reservas.store');

    // Profesor (puede elegir cantidad)
    Route::post('/items-profesor/{item}/reservar', [ReservaController::class, 'storeDocente'])->name('reservas.profesor_store');

    // Ver y cancelar reservas (cualquier usuario)
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('reservas.mis_reservas');
    Route::delete('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');

    /*
    |--------------------------------------------------------------------------
    | Reservas (Admin - aprobar/rechazar)
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/reservas', [ReservaController::class, 'index'])->name('admin.reservas.index');
    Route::patch('/admin/reservas/{reserva}/aprobar', [ReservaController::class, 'aprobar'])->name('admin.reservas.aprobar');
    Route::patch('/admin/reservas/{reserva}/rechazar', [ReservaController::class, 'rechazar'])->name('admin.reservas.rechazar');
});

/*
|--------------------------------------------------------------------------
| Autenticación (Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
