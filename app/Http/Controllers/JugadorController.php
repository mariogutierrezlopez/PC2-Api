<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use App\Http\Resources\JugadorResource;

class JugadorController extends Controller
{
    // Obtener todos los jugadores
    public function index()
    {
    // Obtener todos los jugadores con la relación de equipo
    $jugadores = Jugador::with(['equipo:id,id_web'])->get();

    // Mapear los datos para incluir el id_web del equipo en el jugador
    $jugadores = $jugadores->map(function($jugador) {
        $jugador->equipo_id_web = $jugador->equipo ? $jugador->equipo->id_web : null;

        // Eliminar la relación equipo para no duplicar datos innecesarios
        unset($jugador->equipo);

        return $jugador;
    });

    return JugadorResource::collection($jugadores);
    }


    public function rankingJugadores()
    {
        $jugadores = Jugador::all()->sortByDesc('puntos');

        return response()->json($jugadores);
    }

    // Crear un nuevo jugador
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_web' => 'required|numeric',
            'nombre_del_jugador' => 'required|max:100',
            'id_equipo' => 'required|numeric|exists:equipos,id',
            'posicion' => 'required|max:50',
            // no incluyas 'fecha' si está configurada para ser automática
        ]);

        $jugador = Jugador::create($validatedData);

        return response()->json($jugador, 201);
    }

    // Mostrar un jugador específico
    public function show($id)
    {
        $jugador = Jugador::find($id);

        if ($jugador) {
            return new JugadorResource($jugador);
        } else {
            return response()->json(['error' => 'Jugador no encontrado'], 404);
        }
    }
    

    // Actualizar un jugador específico
    public function update(Request $request, $id)
    {
        $jugador = Jugador::find($id);

        if ($jugador) {
            $validatedData = $request->validate([
                'id_web' => 'required|numeric',
                'nombre_del_jugador' => 'required|max:100',
                'id_equipo' => 'required|numeric|exists:equipos,id',
                'posicion' => 'required|max:50',
                // no incluyas 'fecha' si está configurada para ser automática
            ]);

            $jugador->fill($validatedData);
            $jugador->save();

            return new JugadorResource($jugador);
        } else {
            return response()->json(['error' => 'Jugador no encontrado'], 404);
        }
    }

    // Eliminar un jugador
    public function destroy($id)
    {
        $jugador = Jugador::find($id);

        if ($jugador) {
            $jugador->delete();
            return response()->json(['message' => 'Jugador eliminado'], 200);
        } else {
            return response()->json(['error' => 'Jugador no encontrado'], 404);
        }
    }

}


