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


    /**
     * Crea nuevas estadísticas asociadas a un equipo utilizando los datos recibidos en la petición
     * /api/estadisticas-equipos
     * {
     *   "id_equipo": id_del_equipo_al_que_le_pertenecen_las_estadisticas_a_continuación,
     *   "puntos": puntos_totales_obtenidos_del_equipo,
     *   "media_puntos_jornada": media_puntos_obtenidos_por_jornada,
     *   "valor": valor_del_equipo,
     *   "num_jugadores": número_jugaodres_que_tiene_el_equipo
     *  }
     */
     public function store(Request $request)
    {
        $request->validate([
            'id_equipo' => 'required',
            'puntos' => 'required',
            'media_puntos_jornada' => 'required',
            'valor' => 'required',
            'num_jugadores' => 'required',
        ]);
    
        $requestData = $request->all();
        $requestData['created_at'] = now(); // Establecer el valor de created_at como la fecha y hora actual
    
        $estadisticasEquipo = new EstadisticasEquipos();
        $estadisticasEquipo->fill($requestData)->save();
    
        return response()->json($estadisticasEquipo, 201);
    }


     /**
     * Actualizar TODAS las estadisticas asociadas a un equipo por su ID de estadística.
     * api/estadisticas-equipos/{id}
     * {
     *   "id_equipo": id_del_nuevo_equipo_al_que_le_pertenecen_las_estadisticas_a_continuación,
     *   "puntos": nuevos_puntos_totales_obtenidos_del_equipo,
     *   "media_puntos_jornada": uemedia_puntos_obtenidos_por_jornada,
     *   "valor": valor_del_equipo,
     *   "num_jugadores": número_jugaodres_que_tiene_el_equipo
     *  }
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id_equipo' => 'required',
            'puntos' => 'required',
            'media_puntos_jornada' => 'required',
            'valor' => 'required',
            'num_jugadores' => 'required',
        ]);

        // Buscar la estadística por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar los campos con los valores proporcionados en la solicitud
        $estadisticasEquipos->id_equipo = $request->id_equipo;
        $estadisticasEquipos->puntos = $request->puntos;
        $estadisticasEquipos->media_puntos_jornada = $request->media_puntos_jornada;
        $estadisticasEquipos->valor = $request->valor;
        $estadisticasEquipos->num_jugadores = $request->num_jugadores;

        // Guardar los cambios en la base de datos
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'EstadisticasEquipo updated successfully'], 200);
    }

    /* Función para actualizar el id_equipo asociado a las estadísticas
     *  api/estadisticas-equipos/{id}/id-equipo
     *  {
     *   "id_equipo": id_del_nuevo_equipo_al_que_le_pertenecen_las_estadisticas_a_continuación
     *  }
    */
    public function updateIdEquipo(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id_equipo' => 'required|integer'
        ]);

        // Buscar la estadística de equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        // Verificar si se encontró la estadística de equipo
        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar el id_equipo
        $estadisticasEquipos->id_equipo = $request->id_equipo;
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'id_equipo updated successfully']);
    }

    /* Función para actualizar los puntos del equipo
    *  api/estadisticas-equipos/{id}/puntos'
    *  {
    *   "puntos": nuevos_puntos_totales_obtenidos_del_equipo
    *  }
    */
    public function updatePuntos(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'puntos' => 'required|integer'
        ]);

        // Buscar la estadística de equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        // Verificar si se encontró la estadística de equipo
        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar los puntos
        $estadisticasEquipos->puntos = $request->puntos;
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'puntos updated successfully']);
    }

    /* Función para actualizar la media de puntos por jornada
     * api/estadisticas-equipos/{id}/media-puntos-jornada
     * {
     *   "media-puntos-jornada": uemedia_puntos_obtenidos_por_jornada,
     *  }
     */
    public function updateMediaPuntosJornada(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'media_puntos_jornada' => 'required|numeric'
        ]);

        // Buscar la estadística de equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        // Verificar si se encontró la estadística de equipo
        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar la media de puntos por jornada
        $estadisticasEquipos->media_puntos_jornada = $request->media_puntos_jornada;
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'media_puntos_jornada updated successfully']);
    }

    /* Función para actualizar el valor del equipo
    *  api/estadisticas-equipos/{id}/valor'
    *  {
    *   "puntos": nuevos_puntos_totales_obtenidos_del_equipo
    *  }
    */
    public function updateValor(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'valor' => 'required|numeric'
        ]);

        // Buscar la estadística de equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        // Verificar si se encontró la estadística de equipo
        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar el valor
        $estadisticasEquipos->valor = $request->valor;
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'valor updated successfully']);
    }

    /* Función para actualizar el número de jugadores
    *  api/estadisticas-equipos/{id}/num-jugadores
    * {
    *   "num-jugadores": número_jugaodres_que_tiene_el_equipo
    *  }
    */
    public function updateNumJugadores(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'num_jugadores' => 'required|integer'
        ]);

        // Buscar la estadística de equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::find($id);

        // Verificar si se encontró la estadística de equipo
        if (!$estadisticasEquipos) {
            return response()->json(['message' => 'EstadisticasEquipo not found'], 404);
        }

        // Actualizar el número de jugadores
        $estadisticasEquipos->num_jugadores = $request->num_jugadores;
        $estadisticasEquipos->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'num_jugadores updated successfully']);
    }


     /**
     * Eliminar TODAS las estadisticas asociadas a un equipo por su ID.
     * api/estadisticas-equipos/{id}
     */
    public function destroyAllStatsByTeamId($id_equipo)
    {
        // Buscar todas las estadísticas del equipo por su ID
        $estadisticasEquipos = EstadisticasEquipos::where('id_equipo', $id_equipo)->get();

        // Verificar si se encontraron estadísticas para ese equipo
        if ($estadisticasEquipos->isEmpty()) {
            // Devolver un mensaje de error si no se encontraron estadísticas para ese equipo
            return response()->json(['mensaje' => 'No se encontraron estadísticas para el equipo con el ID proporcionado'], 404);
        }

        // Eliminar todas las estadísticas encontradas
        foreach ($estadisticasEquipos as $estadisticas) {
            $estadisticas->delete();
        }

        // Devolver un mensaje de éxito
        return response()->json(['mensaje' => 'Todas las estadísticas del equipo han sido eliminadas correctamente'], 200);
    }
}