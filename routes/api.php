<?php

use App\Http\Controllers\AuthController;
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
use App\Http\Middleware\CheckAdminRole;
use Tymon\JWTAuth\Http\Middleware\Authenticate;
use App\Http\Controllers\AdminController;

// Rutas públicas
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

// Rutas protegidas
Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('jugadores', JugadorController::class);
    Route::apiResource('equipos', EquipoController::class);
    Route::apiResource('jornadas', JornadaController::class);
    Route::apiResource('jugadores_en_posesion', JugadoresPosesionController::class);
    Route::get('ranking-jugadores', [PrediJugadorController::class, 'topJugadores']);
    Route::get('/prediprecios/{id}', [PrediPrecioController::class, 'show']);
    Route::post('/actualizar-jugadores', [JugadoresPosesionController::class, 'actualizarJugadores']);
    Route::get('/jugadores-posesion', [JugadoresPosesionController::class, 'getJugadoresPosesion']);
    Route::get('/user-role', [AuthController::class, 'getUserRole']);
});

// Rutas protegidas para administradores
Route::group(['middleware' => ['auth:api', CheckAdminRole::class]], function () {
    Route::apiResource('usuarios', UsuarioController::class);
    Route::post('soporte_tecnico', [SoporteTecnicoController::class, 'store']);
    Route::get('soporte_tecnico', [SoporteTecnicoController::class, 'index']);
    Route::get('datos_usuario', [UsuarioController::class, 'getUserIdFromToken']);
    Route::put('usuarios/update-values/{id}', [UsuarioController::class, 'updateSpecificValues']);
    Route::get('GestionaUsuario', [GestionUsuarioController::class, 'index']);
    Route::put('GestionaUsuario/{id}', [GestionUsuarioController::class, 'update']);
});
