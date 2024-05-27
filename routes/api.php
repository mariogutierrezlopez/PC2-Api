<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\JugadoresPosesionController;
use App\Http\Controllers\PrediJugadorController;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\UsuarioController;

// Rutas para la gestión
Route::apiResource('jugadores', JugadorController::class);
Route::apiResource('equipos', EquipoController::class);
Route::apiResource('jornadas', JornadaController::class);
Route::apiResource('jugadores_en_posesion', JugadoresPosesionController::class);
Route::apiResource('usuarios', UsuarioController::class);

Route::post('soporte_tecnico', [SoporteTecnicoController::class, 'store']);
Route::get('soporte_tecnico', [SoporteTecnicoController::class, 'index']);

Route::get('ranking-jugadores', [PrediJugadorController::class, 'topJugadores']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('datos_usuario', [UsuarioController::class, 'getUserIdFromToken']);
});