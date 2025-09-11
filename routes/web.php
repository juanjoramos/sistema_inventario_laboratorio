<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí defines todas las rutas de tu aplicación web.
| Estas rutas se cargan por el RouteServiceProvider dentro del grupo
| "web" middleware group.
|
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard genérico (solo para usuarios autenticados y verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas (requieren login)
Route::middleware('auth')->group(function () {

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboards según el rol
    Route::get('/dashboard-admin', function () {
        return view('admin.dashboard');
    })->name('dashboard.admin');

    Route::get('/dashboard-profesor', function () {
        return view('profesor.dashboard');
    })->name('dashboard.profesor');

    Route::get('/dashboard-estudiante', function () {
        return view('estudiante.dashboard');
    })->name('dashboard.estudiante');
});

// Rutas de autenticación generadas por Breeze/Jetstream
require __DIR__.'/auth.php';
