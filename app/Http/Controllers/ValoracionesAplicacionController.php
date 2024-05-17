<?php

namespace App\Http\Controllers;

use App\Models\ValoracionesAplicacion;
use Illuminate\Http\Request;

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

    /**
     * Almacena una nueva valoración.
     * GET http://127.0.0.1:8000/api/valoraciones
     * @param  \Illuminate\Http\Request  $request
     * ej:{
     *     "titulo": "Excelente aplicación",
     *     "contenido": "Esta aplicación es increíble. Tiene muchas características útiles y funciona sin problemas. ¡La recomiendo totalmente!",
     *     "rating": 3
     *     }
     *      
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'rating' => 'required|integer',
        ]);

        // Crear una nueva instancia de ValoracionesAplicacion
        $valoracion = new ValoracionesAplicacion();
        $valoracion->titulo = $request->titulo;
        $valoracion->contenido = $request->contenido;
        $valoracion->rating = $request->rating;

        // Guardar la valoración en la base de datos
        $valoracion->save();

        // Devolver una respuesta JSON con la nueva valoración
        return response()->json($valoracion, 201);
    }
}
