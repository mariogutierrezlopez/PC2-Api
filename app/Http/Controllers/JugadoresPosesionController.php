<?php

namespace App\Http\Controllers;

use App\Models\JugadoresPosesion;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoresPosesionResource;
use App\Models\Jugador;
use App\Models\PrediJugador;
use App\Models\PrediPrecio;
use Illuminate\Support\Facades\Auth;
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

    public function getJugadoresPosesion(Request $request)
    {
        // Obtener el usuario autenticado a partir del token
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
    
        // Obtener los jugadores asociados al usuario
        $jugadoresPosesion = JugadoresPosesion::where('id_usuario', $user->id)
            ->limit(11) // Asegurarse de que solo se obtengan 11 jugadores
            ->get();
    
        // Obtener los detalles de los jugadores y los últimos valores de prediJugador y PrediPrecio
        $jugadores = Jugador::whereIn('id', $jugadoresPosesion->pluck('id_jugador'))->get()->map(function($jugador) {
            // Obtener el último valor de prediJugador para este jugador
            $ultimoPrediJugador = PrediJugador::where('id_jugador', $jugador->id)->orderBy('id', 'desc')->first();
            
            // Obtener el último valor de PrediPrecio para este jugador
            $ultimoPrediPrecio = PrediPrecio::where('id_jugador', $jugador->id)->orderBy('id', 'desc')->first();
            
            // Añadir estos valores a los detalles del jugador
            $jugador->ultimoPrediJugador = $ultimoPrediJugador;
            $jugador->ultimoPrediPrecio = $ultimoPrediPrecio;
            
            return $jugador;
        });
    
        return response()->json($jugadores, 200);
    }

}


