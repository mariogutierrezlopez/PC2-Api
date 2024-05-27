<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'correo' => 'required|string',
            'pass' => 'required|string',
        ]);

        // Credenciales de autenticación
        $credentials = [
            'correo' => $request->input('correo'),
            'password' => $request->input('pass'),
        ];

        // Intentar autenticar al usuario
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }
}
