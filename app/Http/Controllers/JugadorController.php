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
        return JugadorResource::collection(Jugador::all());
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


