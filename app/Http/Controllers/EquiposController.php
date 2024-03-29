<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    /**
     * Devuelve todos los equipos contenidos en la tabla
     * api/equipos
     */
    public function index()
    {
        $equipos = Equipos::all();
        return response()->json($equipos);
    }


    /**
     * Devuelve el equipo especificado por su ID
     * api/equipos/{equipo}
     */
    public function getNameById($id)
    {
        $equipo = Equipos::find($id);

        if ($equipo) {
            return response()->json($equipo);
        } else {
            return response()->json(['mensaje' => 'Equipo no encontrado'], 404);
        }
    }


    /**
     * Devuelve el ID del equipo especificado por su nombre
     * api/equipos/id/{nombre}
     */
    public function getIdByName($nombre)
    {
        // Busca el equipo por su nombre en la base de datos
        $equipo = Equipos::where('nombre', $nombre)->first();

        // Verifica si se encontró el equipo
        if ($equipo) {
            // Si se encontró, devuelve el ID del equipo
            return response()->json(['id_equipo' => $equipo->id_equipo]);
        } else {
            // Si no se encontró el equipo, devuelve una respuesta con un código de estado 404 (no encontrado)
            return response()->json(['mensaje' => 'Equipo no encontrado'], 404);
        }
    }


    /**
     * Crea un nuevo equipo utilizando los datos recibidos
     * api/equipos
     * Body associated:
     * {
     *    "nombre": "nombre_equipo_a_insertar
     * 
     * "
     * }   
     */
    public function store(Request $request)
    {
        $equipos = new Equipos;
        $equipos->nombre = $request->nombre;
        $equipos->save();

        return $equipos;
    }


    /**
     * Eliminar un equipo por su ID.
     * api/equipos/{id}
     */
    public function destroy($id)
    {
        // Buscar el equipo por su ID
        $equipo = Equipos::find($id);

        // Verificar si el equipo existe
        if (!$equipo) {
            return response()->json(['message' => 'Equipo no encontrado'], 404);
        }

        // Eliminar el equipo
        $equipo->delete();

        // Retornar una respuesta exitosa
        return response()->json(['message' => 'Equipo "' . $equipo->nombre . '" eliminado correctamente'], 200);

    }

    
    /**
     * Actualizar el nombre de un equipo.
     * api/equipos/{id}
     */
    public function update(Request $request, Equipos $equipos)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        // Actualizar el nombre del equipo con el valor proporcionado en la solicitud
        $equipos->nombre = $request->nombre;
    
        // Guardar los cambios en la base de datos
        $equipos->save();
    
        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Nombre del equipo actualizado correctamente'], 200);
    }
    
}