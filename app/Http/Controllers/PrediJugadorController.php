<?php

namespace App\Http\Controllers;

use App\Models\PrediJugador;
use App\Models\PrediPrecio;
use Illuminate\Http\Request;

class PrediJugadorController extends Controller
{
    public function topJugadores()
    {
        $ultimaJornada = PrediJugador::selectRaw("MAX(CAST(REPLACE(jornada, 'J', '') AS UNSIGNED)) as max_jornada")
                            ->value('max_jornada');

        $topJugadores = PrediJugador::with(['jugador', 'jugador.prediPrecio'])
                            ->whereRaw("CAST(REPLACE(jornada, 'J', '') AS UNSIGNED) = ?", [$ultimaJornada])
                            ->orderBy('puntos_jornada', 'desc')
                            ->limit(50)
                            ->get()
                            ->map(function($predijugador) {
                                $prediPrecio = PrediPrecio::where('id_jugador', $predijugador->jugador->id_web)->first();
                                return [
                                    'id_jugador' => $predijugador->jugador->id_web,
                                    'jornada' => $predijugador->jornada,
                                    'puntos_jornada' => $predijugador->puntos_jornada,
                                    'nombre_del_jugador' => $predijugador->jugador->nombre_del_jugador,
                                    'puntos_jornada_prediccion' => $predijugador->jugador->prediPuntuacion,
                                    'precio_jugador' => number_format($predijugador->prediPrecio->precio, 0, ',', '.') . ' €',
                                    'prediccion_precio_jugador' => number_format($predijugador->jugador->prediPrecio, 0, ',', '.') . ' €',
                                ];
                            });

        return response()->json($topJugadores);
    }
}