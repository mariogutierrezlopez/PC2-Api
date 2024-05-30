<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

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

        Log::info('Intentando autentificacion con credenciales: ', $credentials);

        // Intentar autenticar al usuario
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            Log::info('Autentificacion fallida: '. $credentials['correo']);
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        Log::info('Autentificacion exitosa: ' . $credentials['correo']);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }

    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre_de_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios',
            'pass' => 'required|string|min:6',
            'fecha_nacimiento' => 'required|date',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear un nuevo usuario
        $user = Usuario::create([
            'nombre_de_usuario' => $request->nombre_de_usuario,
            'correo' => $request->correo,
            'pass' => Hash::make($request->pass),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        // Generar un token JWT para el usuario
        $token = JWTAuth::fromUser($user);

        // Devolver la respuesta con el token
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ], 201);
    }
    public function getUserRole(Request $request)
    {
        $user = Auth::user();
        return response()->json(['role' => $user->rol]);
    }
}
