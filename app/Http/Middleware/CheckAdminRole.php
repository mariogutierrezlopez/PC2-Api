<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        if ($user && $user->rol === 'admin') {
            Log::info('Y');
            return $next($request);
        }
        Log::info('N');
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
