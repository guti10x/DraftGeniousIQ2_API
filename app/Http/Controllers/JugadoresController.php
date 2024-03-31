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
     * Actualiza el conjunto de atributos globales asociados a un jugador
     * PUT api/jugadores/{id}
     * {
     *  "id_equipo": id_del_nuevo_equipo_del_jugador,
     *  "nombre": "nuevo_nombre_del_jugador",
     *  "posicion": "nueva_posición_del_jugador",
     *  "equipo": "nuevo_equipo_del_jugador",
     *  "edad": nueva_edad_del_jugador,
     *  "altura": nueva_altura_del_jugador,
     *  "peso": nievo_peso_del_jugador
     * }
    */
    public function update(Request $request, Jugadores $jugadores)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id_equipo' => 'required|exists:equipos,id_equipo',  // debe existir el equipo y en consecuencia su id para asignar el nuevo ID
            'nombre' => 'required',
            'posicion' => 'required',
            'equipo' => 'required',
            'edad' => 'required',
            'altura' => 'required',
            'peso' => 'required',
        ]);

        // Actualizar los datos del jugador con los valores proporcionados en la solicitud
        $jugadores->update([
            'id_equipo' => $request->id_equipo,
            'nombre' => $request->nombre,
            'posicion' => $request->posicion,
            'equipo' => $request->equipo,
            'edad' => $request->edad,
            'altura' => $request->altura,
            'peso' => $request->peso,
        ]);

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Jugador actualizado correctamente'], 200);
    }

    /**
     * Actualiza el ID del equipo asociado a un jugador.
     * PUT api/jugadores/{id}/update-id-equipo
     * {
     *  "id_equipo": id_del_nuevo_equipo_del_jugador
     * }
    */
    public function updateIdEquipo(Request $request, Jugadores $jugadores)
    {
        // Validar el ID del equipo
        $request->validate([
            'id_equipo' => 'required|exists:equipos,id_equipo',   // debe existir el equipo y en consecuencia su id para asignar el nuevo ID
        ]);
    
        // Actualizar el ID del equipo del jugador
        $jugadores->update([
            'id_equipo' => $request->id_equipo,
        ]);
    
        // Devolver una respuesta exitosa
        return response()->json(['message' => 'ID del equipo actualizado correctamente'], 200);
    }    

    /**
     * Actualiza el nombre de un jugador.
     * PUT api/jugadores/{id}/update-nombre
     * {
     *  "nombre": "nuevo_nombre_del_jugador"
     * }
    */
    public function updateName(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $jugador->nombre = $request->nombre;
        $jugador->save();

        return response()->json(['message' => 'Nombre del jugador actualizado correctamente'], 200);
    }

    /**
     * Actualiza la posición de un jugador.
     * PUT api/jugadores/{id}/update-position
     * {
     *  "posicion": "nueva_posición_del_jugador"
     * }
    */
    public function updatePosition(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'posicion' => 'required|string',
        ]);

        $jugador->posicion = $request->posicion;
        $jugador->save();

        return response()->json(['message' => 'Posición del jugador actualizada correctamente'], 200);
    }

    /**
     * Actualiza el equipo de un jugador.
     * PUT api/jugadores/{id}/update-team
     * {
     *  "equipo": "nuevo_equipo_del_jugador"
     * }
    */
    public function updateTeam(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'equipo' => 'required|string',
        ]);

        $jugador->equipo = $request->equipo;
        $jugador->save();

        return response()->json(['message' => 'Equipo del jugador actualizado correctamente'], 200);
    }

    /**
     * Update the age of the player.
     * PUT api/jugadores/{id}/edad
     * {
     *  "edad": nueva_edad_del_jugador
     * }
     */
    public function updateAge(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'edad' => 'required|integer',
        ]);

        $jugador->edad = $request->edad;
        $jugador->save();

        return response()->json(['message' => 'Edad del jugador actualizada correctamente'], 200);
    }

    /**
     * Actualiza la altura de un jugador.
     * PUT api/jugadores/{id}/altura
     * {
     *  "edad": nueva_altura_del_jugador
     * }
    */
    public function updateHeight(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'altura' => 'required|numeric',
        ]);

        $jugador->altura = $request->altura;
        $jugador->save();

        return response()->json(['message' => 'Altura del jugador actualizada correctamente'], 200);
    }

    /**
     * Actualiza la altura de un jugador.
     * PUT api/jugadores/{id}/update-height
     * {
     *  "altura": nueva_altura_del_jugador
     * }
    */
    public function updateWeight(Request $request, Jugadores $jugador)
    {
        $request->validate([
            'peso' => 'required|integer',
        ]);

        $jugador->peso = $request->peso;
        $jugador->save();

        return response()->json(['message' => 'Peso del jugador actualizado correctamente'], 200);
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
