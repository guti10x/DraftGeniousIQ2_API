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
     * Añadir a la tabla jugadores un nuevo jugador con sus estadísticas globales asociadas
     * POST api/jugadores
     * {
     * "nombre": "mombre del jugaodr a insertar",
     * "posicion": "posición_del_jugador_a_insertar",
     * "equipo": "equipo_del_jugador_a_insertar",
     * "edad": "edad_del_jugador_a_insertar,
     * "altura": "altura_del_jugador_a_insertar,
     * "peso": "peso_del_jugador_a_insertar
     * }
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre' => 'required',
            'posicion' => 'required',
            'equipo' => 'required',
            'edad' => 'required|integer',
            'altura' => 'required|numeric',
            'peso' => 'required|integer',
        ]);
    
        // Crear una nueva instancia del modelo Jugador y asignar los valores de la solicitud
        $jugador = new Jugadores();
        $jugador->nombre = $request->nombre;
        $jugador->posicion = $request->posicion;
        $jugador->equipo = $request->equipo;
        $jugador->edad = $request->edad;
        $jugador->altura = $request->altura;
        $jugador->peso = $request->peso;
    
        // Guardar el jugador en la base de datos
        $jugador->save();
    
        // Devolver una respuesta indicando que el jugador se ha almacenado correctamente
        return response()->json(['message' => 'Jugador almacenado correctamente'], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jugadores $jugadores)
    {
        //
    }

    /**
     * Eliminar un jugador por su id
     * DELETE api/jugadores/{id}
     */
    public function destroy($id)
    {
        // Buscar el jugador por su ID
        $jugador = Jugadores::find($id);

        // Verificar si el jugador existe
        if (!$jugador) {
            // Si el jugador no existe, devolver un mensaje de error
            return response()->json(['message' => 'Jugador no encontrado'], 404);
        }

        // Eliminar el jugador de la base de datos
        $jugador->delete();

        // Devolver un mensaje de éxito
        return response()->json(['message' => 'Jugador eliminado correctamente']);
    }

}
