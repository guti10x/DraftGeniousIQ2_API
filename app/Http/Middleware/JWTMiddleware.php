<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Verificar y autenticar el token JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // Token ha expirado
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            // Token no es válido
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            // Token no se encuentra
            return response()->json(['error' => 'Token is missing'], 401);
        } catch (Exception $e) {
            // Otro error
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Si la autenticación es exitosa, continuar con la solicitud
        return $next($request);
    }
}