<?php

namespace App\Http\Controllers;

use App\Models\ValoracionesAplicacion;

class ValoracionesAplicacionController extends Controller
{
    /**
     * Devuelve las 3 valoraciones más recientes basadas en la columna updated_at.
     * GET http://127.0.0.1:8000/api/valoraciones-recientes
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecentValoraciones()
    {
        // Obtener las 3 valoraciones más recientes
        $recentValoraciones = ValoracionesAplicacion::orderBy('updated_at', 'desc')->take(3)->get();

        // Retornar los resultados como una respuesta JSON
        return response()->json($recentValoraciones);
    }
}
