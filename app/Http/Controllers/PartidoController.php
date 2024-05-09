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
