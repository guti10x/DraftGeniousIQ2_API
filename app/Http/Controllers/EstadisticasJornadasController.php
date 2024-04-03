<?php

namespace App\Http\Controllers;

use App\Models\EstadisticasJornadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EstadisticasJornadasController extends Controller
{
    /**
     * Devuelve TODAS las estadísticas asociadas a TODOS los jugadores
     * GET api/estadisticas-jornadas
     */
    public function index()
    {
        $estadisticasJornadas = EstadisticasJornadas::all();
        return response()->json(['data' => $estadisticasJornadas], 200);
    }

    
    /**
     * Devuelve TODAS las últimas estadísticas (las más recientes), asociadas al id de un jugador que NO son nulas
     * GET api/estadisticas-jornadas/{id_jugador}/estadisticas
     *
     */
     public function mostrarTodasEstadisticasJugador($id)
    {
        // Obtener las estadísticas de jornadas para el jugador con el ID especificado con el created_at más reciente
        $estadisticasJornadas = EstadisticasJornadas::where('id_player', $id)
        ->orderBy('created_at', 'desc')
        ->first();


        // Verificar si se encontraron estadísticas para el jugador dado
        if ($estadisticasJornadas) {
            // Array donde se almacenarán los atributos no nulos junto con sus claves
            $datos = [];
            foreach ($estadisticasJornadas->getAttributes() as $columna => $valor) {
                if (!is_null($valor)) {
                    $datos[$columna] = $valor;
                }
            }
            // Devolver los datos junto con el código de estado 200 (OK)
            return response()->json(['data' => $datos], 200);
        } else {
            // Si no se encontraron estadísticas para el jugador dado, devolver un mensaje de error
            return response()->json(['message' => 'No se encontraron estadísticas para el jugador especificado'], 404);
        }
    }

    /**
     * Devuelve estadísticas principales del jugador, asociadas al id de un jugador que NO son nulas
     * GET api/estadisticas-jornadas/{id_jugador}/estadisticasMain
     *
     */


    /*
     * Almacenar estadísticas asociadas a un jugador (id_player) y jornada 
     * (se le pasa un conjunto de estadísticas las cuales si la la clave(nombre) de la estadística existe lo almacena en la bd y si no existe no lo almacena)
     * POST api/estadisticas-jornadas
     * 
     * {
        "jornada": INT,
        "id_player":INT,
        "puntuacion_fantasy":INT,
        "puntuacion_as":INT,
        "puntuacion_marca":INT,
        "puntuacion_mundo_deportivo":INT,
        "media_puntos_visitante":INT,
        "media_puntos_local":INT,
        "valor_mercado":INT,
        "ultimo_rival": TEXT,
        "resultado_del_partido": TEXT,
        "proximo_rival": TEXT,
        "proximo_partido_es_local": TEXT,
        "balones_en_largo_totales": INT,
        "ocasiones_claras_falladas": INT,
        "tiros_bloqueados_en_defensa": INT,
        "entradas_como_último_hombre": INT,
        "goles_evitados": FLOAT,
        "salidas_precisas": INT,
        "minutos_jugados": INT,
        "goles_esperados": FLOAT,
        "balones_en_largo_precisos": INT,
        "intercepciones": INT,
        "tiros_fuera": INT,
        "tiros_bloqueados_en_ataque": INT,
        "posesiones_perdidas": INT,
        "paradas_desde_dentro_del_área": INT,
        "centros_totales": INT,
        "entradas_totales": INT,
        "despejes_por_alto": INT,
        "duelos_aéreos_perdidos": INT,
        "duelos_ganados": INT,
        "pases_totales": INT,
        "penaltis_cometidos": INT,
        "asistencias_esperadas": FLOAT,
        "pérdidas": INT,
        "regates_totales": INT,
        "penaltis_provocados": INT,
        "despejes_con_los_puños": INT,
        "goles": INT,
        "asistencias_de_gol": INT,
        "tiros_al_palo": INT,
        "regates_completados": INT,
        "ocasiones_creadas": INT,
        "penaltis_fallados": INT,
        "pases_clave": INT,
        "tiros_a_puerta": INT,
        "fueras_de_juego": INT,
        "centros_precisos": INT,
        "errores_que_llevan_a_disparo": INT,
        "despejes_totales": INT,
        "duelos_aéreos_ganados": INT,
        "paradas": INT,
        "pases_precisos": INT,
        "toques": INT,
        "duelos_perdidos": INT,
        "faltas_recibidas": INT,
        "errores_que_llevan_a_gol": INT,
        "salidas_totales": INT,
        "penaltis_parados": INT,
        "regateado": INT,
        "faltas_cometidas": INT
        }
    */
    public function store(Request $request)
    {
        // Obtener los nombres de las columnas de la tabla de estadísticas
        $columnas = Schema::getColumnListing('estadisticas_jornadas');
        
        // Filtrar los datos recibidos para quedarse solo con las estadísticas existentes en la base de datos
        $datosEstadisticas = $request->only($columnas);
        
        // Obtener las claves de los datos enviados en la solicitud
        $clavesEnviadas = array_keys($request->all());
        
        // Encontrar las claves que no se insertaron
        $clavesFaltantes = array_diff($clavesEnviadas, $columnas);
        
        // Insertar los datos filtrados en la base de datos
        EstadisticasJornadas::create($datosEstadisticas);
        
        // Devolver un mensaje con las claves que no se insertaron
        if (!empty($clavesFaltantes)) {
            return response()->json(['message' => 'Las siguientes estadísticas no se insertaron en la bd porque no existen dichos atributos en la base de datos:', 'missing_keys' => $clavesFaltantes], 200);
        } else {
            return response()->json(['message' => 'Todas las Estadísticas insertadas correctamente'], 200);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadisticasJornadas $estadisticasJornadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadisticasJornadas $estadisticasJornadas)
    {
        //
    }
}