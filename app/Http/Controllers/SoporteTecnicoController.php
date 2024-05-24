<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoporteTecnicoResource;
use App\Models\SoporteTecnico;
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
}
