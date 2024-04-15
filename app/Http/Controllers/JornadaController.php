<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;
use App\Http\Resources\JornadasResource;

class JornadaController extends Controller
{
    // Obtener todos los jornada
    public function index()
    {
        return JornadasResource::collection(Jornada::all());
    }

    // Crear un nuevo jornada
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jornada' => 'required|max:100',
            'id_local' => 'required|numeric|exists:equipos,id',
            'id_visitante' => 'required|numeric|exists:equipos,id',
        ]);

        $jornada = Jornada::create($validatedData);

        return response()->json($jornada, 201);
    }

    // Mostrar un jornada específico
    public function show($id)
    {
        $jornada = Jornada::find($id);

        if ($jornada) {
            return new JornadasResource($jornada);
        } else {
            return response()->json(['error' => 'jornada no encontrado'], 404);
        }
    }
    

    // Actualizar un jornada específico
    public function update(Request $request, $id)
    {
        $jornada = Jornada::find($id);

        if ($jornada) {
            $validatedData = $request->validate([
                'jornada' => 'required|max:100',
                'id_local' => 'required|numeric|exists:equipos,id',
                'id_visitante' => 'required|numeric|exists:equipos,id',
            ]);

            $jornada->fill($validatedData);
            $jornada->save();

            return new JornadasResource($jornada);
        } else {
            return response()->json(['error' => 'jornada no encontrado'], 404);
        }
    }

    // Eliminar un jornada
    public function destroy($id)
    {
        $jornada = Jornada::find($id);

        if ($jornada) {
            $jornada->delete();
            return response()->json(['message' => 'jornada eliminado'], 200);
        } else {
            return response()->json(['error' => 'jornada no encontrado'], 404);
        }
    }

}


