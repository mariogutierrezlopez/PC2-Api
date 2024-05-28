<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionUsuario;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\GestionUsuarioResource;
use Illuminate\Support\Facades\Validator;

class GestionUsuarioController extends Controller
{
    public function index()
    {
        return GestionUsuario::all();
    }

    public function update(Request $request, $id)
    {
        $usuario = GestionUsuario::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'pass' => 'sometimes|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if ($request->has('pass')) {
            $request->merge(['pass' => Hash::make($request->pass)]);
        }

        $usuario->update($request->all());
        return response()->json(new GestionUsuarioResource($usuario), 200);
    }
}
