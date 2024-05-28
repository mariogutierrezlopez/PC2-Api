<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionUsuario;
use App\Http\Resources\GestionUsuarioResource;
use Illuminate\Support\Facades\Validator;

class GestionUsuarioController extends Controller
{public function index()
    {
        return GestionUsuario::all();
    }

    public function update(Request $request, $id)
    {
        $usuario = GestionUsuario::findOrFail($id);
        $usuario->update($request->all());
        return $usuario;
    }
}