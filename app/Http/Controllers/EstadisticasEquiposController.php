<?php

namespace App\Http\Controllers;

use App\Models\EstadisticasEquipos;
use Illuminate\Http\Request;

class EstadisticasEquiposController extends Controller
{
    /**
     * Devuelve todos las estadísticas de todos los equipos contenidos en la tabla
     * api/estadisticas-equipos
     */
    public function index()
    {
        $estadisticasEquipos = EstadisticasEquipos::all();
        return response()->json($estadisticasEquipos);
    }


    /**
     * Mostrar estadisticas asociadas a un equipo por su ID
     * api/estadisticas-equipos/{id_equipo}/stats
     */
    public function getStatsById($id_equipo)
    {
        // Buscar todas las estadísticas del equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::where('id_equipo', $id_equipo)->get();
    
        // Verificar si se encontraron estadísticas para ese equipo
        if ($estadisticasEquipos->isEmpty()) {
            // Devolver un mensaje de error si no se encontraron estadísticas para ese equipo
            return response()->json(['mensaje' => 'No se encontraron estadísticas para el equipo con el ID proporcionado'], 404);
        }
    
        // Devolver las estadísticas del equipo como respuesta
        return response()->json($estadisticasEquipos, 200);
    }
    


    /**
     * Mostrar la última estadisticas asociadas a un equipo por su ID
     * api/estadisticas-equipos/{id_equipo}/last-stats
     */
    public function getLastStatsById($id_equipo)
    {
        // Buscar las estadísticas del equipo por su ID, ordenadas por fecha de actualización descendente
        $lastStats = EstadisticasEquipos::where('id_equipo', $id_equipo)
                                        ->orderBy('updated_at', 'desc')
                                        ->first();
    
        if ($lastStats) {
            // Devolver las estadísticas del equipo si se encuentran
            return response()->json($lastStats, 200);
        } else {
            // Devolver un mensaje de error si no se encuentran estadísticas para ese equipo
            return response()->json(['mensaje' => 'No se encontraron estadísticas para el equipo con el ID proporcionado'], 404);
        }
    }
}
