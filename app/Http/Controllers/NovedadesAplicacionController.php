<?php

namespace App\Http\Controllers;

use App\Models\NovedadesAplicacion;

class NovedadesAplicacionController extends Controller
{
    /**
     * Devuelve las 3 novedades más recientes basadas en la columna updated_at.
     * GET http://127.0.0.1:8000/api/novedades-recientes
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecentUpdates()
    {
        // Obtener las 3 filas más recientes
        $recentUpdates = NovedadesAplicacion::orderBy('updated_at', 'desc')->take(3)->get();

        // Retornar los resultados como una respuesta JSON
        return response()->json($recentUpdates);
    }
}
