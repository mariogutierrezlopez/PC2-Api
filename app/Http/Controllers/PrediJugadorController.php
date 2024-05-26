<?php

namespace App\Http\Controllers;

use App\Models\PrediJugador;
use Illuminate\Http\Request;

class PrediJugadorController extends Controller
{
    public function topJugadores()
    {
        // Obtener el valor máximo de la jornada
        $ultimaJornada = Predijugador::selectRaw("MAX(CAST(REPLACE(jornada, 'J', '') AS UNSIGNED)) as max_jornada")
                            ->value('max_jornada');

        // Obtener los 50 jugadores con más puntos en la última jornada
        $topJugadores = Predijugador::with('jugador')
                            ->whereRaw("CAST(REPLACE(jornada, 'J', '') AS UNSIGNED) = ?", [$ultimaJornada])
                            ->orderBy('puntos_jornada', 'desc')
                            ->limit(50)
                            ->get()
                            ->map(function($predijugador) {
                                return [
                                    'id_jugador' => $predijugador->jugador->id_web,
                                    'jornada' => $predijugador->jornada,
                                    'puntos_jornada' => $predijugador->puntos_jornada,
                                    'nombre_del_jugador' => $predijugador->jugador->nombre_del_jugador,
                                ];
                            });

        return response()->json($topJugadores);
    }
}
