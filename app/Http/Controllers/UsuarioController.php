<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de que el modelo Usuario corresponde a tu tabla.
use App\Http\Resources\UsuariosResource;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Devuelve todos los usuarios con paginación
        return UsuariosResource::collection(Usuario::paginate());
    }

    public function store(Request $request)
    {
        // Valida la solicitud
        $validatedData = $request->validate([
            'nombre_de_usuario' => 'required|string|max:100|unique:usuarios',
            'nombre_mister' => 'nullable|string|max:50',
            'correo' => 'required|string|email|max:100|unique:usuarios',
            'pass' => 'required|string|min:6',
            'pass_mister' => 'nullable|string|min:6',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Crea y guarda el usuario
        $usuario = Usuario::create($validatedData);

        return new UsuariosResource($usuario);
    }

    public function show($id)
    {
        // Busca el usuario o falla con un error 404
        $usuario = Usuario::findOrFail($id);

        return new UsuariosResource($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Valida la solicitud
        $validatedData = $request->validate([
            'nombre_de_usuario' => 'required|string|max:100|unique:usuarios,nombre_de_usuario,' . $usuario->id,
            'nombre_mister' => 'nullable|string|max:50',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,' . $usuario->id,
            'pass' => 'required|string|min:6',
            'pass_mister' => 'nullable|string|min:6',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Actualiza el usuario con los datos validados
        $usuario->update($validatedData);

        return new UsuariosResource($usuario);
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->delete();

        // Devuelve un código de respuesta HTTP 204 - No Content.
        return response()->json(null, 204);
    }
}
