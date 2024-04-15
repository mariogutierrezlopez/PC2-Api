<?php

namespace App\Http\Controllers;

use App\Models\JugadoresPosesion;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoresPosesionResource;

class JugadoresPosesionController extends Controller
{
    // Obtener todos los JugadoresPosesion
    public function index()
    {
        return JugadoresPosesionResource::collection(JugadoresPosesion::all());
    }

    // Crear un nuevo JugadoresPosesion
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_usuario' => 'required|numeric|exists:usuarios,id',
            'id_jugador' => 'required|numeric|exists:jugadores,id',
        ]);

        $jugadoresPosesion = JugadoresPosesion::create($validatedData);

        return response()->json($jugadoresPosesion, 201);
    }

    // Mostrar un JugadoresPosesion específico
    public function show($id)
    {
        $jugadoresPosesion = JugadoresPosesion::find($id);

        if ($jugadoresPosesion) {
            return new JugadoresPosesionResource($jugadoresPosesion);
        } else {
            return response()->json(['error' => 'JugadoresPosesion no encontrado'], 404);
        }
    }
    

    // Actualizar un JugadoresPosesion específico
    public function update(Request $request, $id)
    {
        $jugadoresPosesion = JugadoresPosesion::find($id);

        if ($jugadoresPosesion) {
            $validatedData = $request->validate([
            'id_usuario' => 'required|numeric|exists:usuarios,id',
            'id_jugador' => 'required|numeric|exists:jugadores,id',
            ]);

            $jugadoresPosesion->fill($validatedData);
            $jugadoresPosesion->save();

            return new JugadoresPosesionResource($jugadoresPosesion);
        } else {
            return response()->json(['error' => 'JugadoresPosesion no encontrado'], 404);
        }
    }

    // Eliminar un JugadoresPosesion
    public function destroy($id)
    {
        $jugadoresPosesion = JugadoresPosesion::find($id);

        if ($jugadoresPosesion) {
            $jugadoresPosesion->delete();
            return response()->json(['message' => 'JugadoresPosesion eliminado'], 200);
        } else {
            return response()->json(['error' => 'JugadoresPosesion no encontrado'], 404);
        }
    }

}


