<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use Illuminate\Http\Request;

class JugadoresController extends Controller
{
    /**
     * Obtener todos los jugadores y estadísticas asociadas almacenadas en la base de datos
     * GET api/jugadores/
     */
    public function index()
    {
        // Obtener todos los jugadores de la base de datos
        $jugadores = Jugadores::all();
        
        // Devolver los jugadores como respuesta en formato JSON
        return response()->json($jugadores, 200);
    }

    /**
     * Obtener jugador por su ID y devolver nombre, posición y equipo.
     * GET api/jugadores/{id}/nombre-posicion-equipo
     */
    public function getNombrePosicionEquipo($id)
    {
        $jugador = Jugadores::findOrFail($id);

        $jugadorInfo = [
            'nombre' => $jugador->nombre,
            'posicion' => $jugador->posicion,
            'equipo' => $jugador->equipo,
        ];

        return response()->json($jugadorInfo, 200);
    }

    /**
     * Buscar jugador por su ID y devolver edad, altura y peso.
     * GET api/jugadores/{id}/edad-altura-peso
     */
    public function getEdadAlturaPeso($id)
    {
        $jugador = Jugadores::findOrFail($id);

        $jugadorInfo = [
            'edad' => $jugador->edad,
            'altura' => $jugador->altura,
            'peso' => $jugador->peso,
        ];

        return response()->json($jugadorInfo, 200);
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
    public function show(Jugadores $jugadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugadores $jugadores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugadores $jugadores)
    {
        //
    }
}
