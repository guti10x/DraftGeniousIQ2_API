<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el valor del encabezado X-User-Rol
        $userRol = $request->header('X-User-Rol');

        // Verificar si el valor es 1
        if ($userRol == 1) {
            // Permitir acceso al endpoint
            return $next($request);
        }

        // Si el valor no es 1, bloquear la petición
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}