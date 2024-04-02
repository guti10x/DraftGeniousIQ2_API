<?php

namespace App\Http\Controllers;

use App\Models\EstadisticasJornadas;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadisticasJornadas $estadisticasJornadas)
    {
        //
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