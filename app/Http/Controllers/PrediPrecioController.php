<?php

namespace App\Http\Controllers;

use App\Models\PrediPrecio;
use Illuminate\Http\Request;

class PrediPrecioController extends Controller
{
    public function index()
    {
        $prediPrecios = PrediPrecio::all();
        return response()->json($prediPrecios);
    }

    public function show($id)
    {
        $prediPrecio = PrediPrecio::findOrFail($id);
        return response()->json($prediPrecio);
    }

    public function store(Request $request)
    {
        $prediPrecio = PrediPrecio::create($request->all());
        return response()->json($prediPrecio, 201);
    }

    public function update(Request $request, $id)
    {
        $prediPrecio = PrediPrecio::findOrFail($id);
        $prediPrecio->update($request->all());
        return response()->json($prediPrecio, 200);
    }

    public function delete($id)
    {
        $prediPrecio = PrediPrecio::findOrFail($id);
        $prediPrecio->delete();
        return response()->json(null, 204);
    }
}
