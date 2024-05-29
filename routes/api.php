<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\JugadoresPosesionController;
use App\Http\Controllers\PrediJugadorController;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PrediPrecioController;

// Rutas para la gestión
Route::apiResource('jugadores', JugadorController::class);
Route::apiResource('equipos', EquipoController::class);
Route::apiResource('jornadas', JornadaController::class);
Route::apiResource('jugadores_en_posesion', JugadoresPosesionController::class);
Route::apiResource('usuarios', UsuarioController::class);

Route::post('soporte_tecnico', [SoporteTecnicoController::class, 'store']);
Route::get('soporte_tecnico', [SoporteTecnicoController::class, 'index']);

Route::get('/prediprecios/{id}', [PrediPrecioController::class, 'show']);
Route::get('ranking-jugadores', [PrediJugadorController::class, 'topJugadores']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('datos_usuario', [UsuarioController::class, 'getUserIdFromToken']);
});

Route::middleware('auth:api')->group(function () {
    Route::put('usuarios/update-values/{id}', [UsuarioController::class, 'updateSpecificValues']);
});

Route::get('GestionaUsuario', [GestionUsuarioController::class, 'index']);
Route::put('GestionaUsuario/{id}', [GestionUsuarioController::class, 'update']);

Route::post('/actualizar-jugadores', [JugadoresPosesionController::class, 'actualizarJugadores']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/jugadores-posesion', [JugadoresPosesionController::class, 'getJugadoresPosesion']);
});