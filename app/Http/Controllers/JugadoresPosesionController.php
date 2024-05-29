<?php

namespace App\Http\Controllers;

use App\Models\JugadoresPosesion;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoresPosesionResource;
use Illuminate\Support\Facades\DB;

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

    public function actualizarJugadores(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'jugadores' => 'required|array|min:11|max:11',
            'jugadores.*' => 'required|integer'
        ]);

        $idUsuario = $request->input('id_usuario');
        $jugadores = $request->input('jugadores');

        DB::transaction(function () use ($idUsuario, $jugadores) {
            // Eliminar jugadores actuales del usuario
            JugadoresPosesion::where('id_usuario', $idUsuario)->delete();

            // Insertar nuevos jugadores
            foreach ($jugadores as $idJugador) {
                JugadoresPosesion::create([
                    'id_usuario' => $idUsuario,
                    'id_jugador' => $idJugador,
                ]);
            }
        });

        return response()->json(['message' => 'Jugadores actualizados correctamente'], 200);
    }

}


