<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Devolver todos los partidos registrados en la bd
     * GET /api/partidos/last-jornada-matches
     */
    public function index()
    {
        // Obtener todos los partidos
        $partidos = Partido::all();

        // Devolver los partidos encontrados
        return response()->json($partidos, 200);
    }

    /**
     * Obtener todos los partidos de la última jornada registrada en la bd.
     * GET /api/partidos/last-jornada-matches
     */
    public function lastJornadaPartidos()
    {
        // Obtener el máximo valor de la jornada
        $maxJornada = Partido::max('jornada');

        // Verificar si se encontró un valor máximo
        if ($maxJornada !== null) {
            // Obtener todos los partidos cuya jornada sea igual al máximo valor
            $partidos = Partido::where('jornada', $maxJornada)->get();

            // Devolver los partidos encontrados
            return response()->json($partidos, 200);
        } else {
            // Si no se encontraron partidos, devolver un mensaje de error
            return response()->json(['message' => 'No se encontraron partidos.'], 404);
        }
    }

    /**
     * Devuelve el último partido disputado, priorizando el más reciente en caso de empate en la fecha de actualización, se selecciona el partido con el máximo número de goles en cualquiera de los equipos.
     * GET /api/partidos/recent-match
     */
    public function getRecentMatch()
    {
        // Obtener el partido más reciente ordenado por updated_at y, en caso de empate,
        // obtener el partido con el máximo número de goles en cualquiera de los equipos
        $recentMatch = Partido::orderBy('updated_at', 'desc')
                            ->orderByRaw('GREATEST(goles_local, goles_visitante) desc')
                            ->first();

        return response()->json($recentMatch);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Partido $partido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partido $partido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partido $partido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partido $partido)
    {
        //
    }
}
