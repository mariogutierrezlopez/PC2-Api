<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoporteTecnicoResource;
use App\Models\SoporteTecnico;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SoporteTecnicoController extends Controller{
    public function index()
    {
        $soportes = SoporteTecnico::with('usuario')
            ->get()
            ->map(function ($soporte) {
                return [
                    'id' => $soporte->id,
                    'problema' => $soporte->problema,
                    'descripcion' => $soporte->descripcion,
                    'fecha_mensaje' => $soporte->fecha_mensaje,
                    'correo' => $soporte->correo,
                    'nombre_de_usuario' => $soporte->usuario->nombre_de_usuario ?? null,
                    'nombre' => $soporte->usuario->nombre ?? null,
                    'apellido' => $soporte->usuario->apellido ?? null,
                ];
            });

        return response()->json($soportes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required',
            'problema' => 'required',
            'descripcion' => 'required',
        ]);

        // Verificar si el correo electrónico existe en la tabla de usuarios
        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Tu correo no está registrado en CactusPanda'], 404);
        }

        $soporteId = SoporteTecnico::insertGetId([
            'correo' => $request->correo,
            'problema' => $request->problema,
            'descripcion' => $request->descripcion,
            'fecha_mensaje' => now(),
        ]);

        return response()->json(['message' => 'Solicitud de soporte técnico creada con éxito'], 201);
    }
}
