<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\EstadisticaController;


Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [EstadisticaController::class, 'dashboard'])->name('dashboard');
    Route::get('/posiciones', [EstadisticaController::class, 'posiciones'])->name('posiciones');

    Route::resource('equipos', EquipoController::class);

    Route::resource('equipos.jugadores', JugadorController::class)
        ->shallow()
        ->except(['index', 'show'])
        ->parameters(['jugadores' => 'jugador']);

    Route::resource('partidos', PartidoController::class)->except('show');
});
