<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Http\Resources\EquiposResource;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        return EquiposResource::collection(Equipo::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_equipo' => 'required|max:255',
        ]);

        $equipo = Equipo::create($validatedData);

        return new EquiposResource($equipo);
    }

    public function show($id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }
        return new EquiposResource($equipo);
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre_equipo' => 'required|max:255',
        ]);

        $equipo->fill($validatedData);
        $equipo->save();

        return new EquiposResource($equipo);
    }

    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }

        $equipo->delete();

        return response()->json(['message' => 'Equipo eliminado'], 200);
    }
}
