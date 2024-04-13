<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use App\Models\predicciones_puntos;
use Illuminate\Http\Request;

class PrediccionesPuntosController extends Controller
{
    /* Obtener todas las predicciones_de_puntos almacenadas en la bd
    *  GET api/pred_puntos
    */
    public function index()
    {
        // Obtener todas las predicciones de puntos almacenadas en la bd
        $predicciones = predicciones_puntos::all();

        // Devolver las predicciones como respuesta en formato JSON
        return response()->json(['predicciones_puntos' => $predicciones]);
    }

    /*
    * Obtener TODAS las predicciones_de_puntos asociadas a un player
    * GET api/pred_puntos/player/{id_player}
    */
    public function getByPlayer($id_player)
    {
        // Obtener todas las predicciones de puntos asociadas a un jugador específico
        $predicciones = predicciones_puntos::where('id_player', $id_player)->get();

        // Devolver las predicciones como respuesta en formato JSON
        return response()->json(['predicciones_puntos' => $predicciones]);
    }

    /*
    *  Obtener LA ÚLTIMA predicción_de_puntos asociada a un player
    *  GET api/pred_puntos/player/{id_player}
    */
    public function getLastByPlayer($id_player)
    {
        // Obtener la última predicción de puntos asociada a un jugador específico, ordenada por updated_at
        $ultimaPrediccion = predicciones_puntos::where('id_player', $id_player)->latest('updated_at')->first();

        // Devolver la última predicción como respuesta en formato JSON
        return response()->json(['ultima_prediccion_puntos' => $ultimaPrediccion]);
    }

    /*
     * Almacenar nueva predicción_de_puntos asociada a un jugador
     * STORE api/pred_puntos
    */ 
    public function store(Request $request)
    {
        // Validar los datos recibidos en la petición
        $request->validate([
            'id_player' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        // Verificar si el jugador con el id_player proporcionado existe
        $jugador = Jugadores::find($request->id_player);
        if (!$jugador) {
            return response()->json(['message' => 'El ID del jugador proporcionado no existe'], 404);
        }

        // Crear una nueva predicción de puntos con los datos recibidos
        $prediccion = predicciones_puntos::create([
            'id_player' => $request->id_player,
            'valor' => $request->valor,
        ]);

        // Devolver una respuesta JSON con la nueva predicción creada y el código de estado 201 (creado)
        return response()->json(['prediccion_puntos' => $prediccion], 201);
    }


    /* 
     * Modificar id_player asociado a la predicción_de_puntos por id de la predicción
     * PUT api/pred_puntos/{id_prediccion}/update_player
    */
    public function updatePlayer(Request $request, $id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_puntos::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de puntos no fue encontrada'], 404);
        }

        // Validar los datos recibidos en la petición
        $request->validate([
            'id_player' => 'required|integer',
        ]);

        // Verificar si el jugador con el id_player proporcionado existe
        $jugador = Jugadores::find($request->id_player);
        if (!$jugador) {
            return response()->json(['message' => 'El ID del jugador proporcionado no existe'], 404);
        }

        // Actualizar el id_player asociado a la predicción
        $prediccion->id_player = $request->id_player;
        $prediccion->save();

        // Devolver una respuesta indicando que la predicción fue modificada correctamente
        return response()->json(['message' => 'ID del jugador asociado a la predicción de puntos actualizado correctamente']);
    }

    /* 
     * Modificar valor de la predicción_de_puntos por id de la predicción
     * PUT api/pred_puntos/{id_prediccion}/update_value
    */
     public function updateValue(Request $request, $id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_puntos::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de puntos no fue encontrada'], 404);
        }

        // Validar los datos recibidos en la petición
        $request->validate([
            'valor' => 'required|numeric',
        ]);

        // Actualizar el valor de la predicción
        $prediccion->valor = $request->valor;
        $prediccion->save();

        // Devolver una respuesta indicando que la predicción fue modificada correctamente
        return response()->json(['message' => 'Valor de la predicción de puntos actualizado correctamente']);
    }


    /*  
    *  Eliminar ultima predicción_de_puntos asociada a un player 
    *  DELETE api/pred_puntos/player/{id_player}/last
    */
    public function deleteLastByPlayer($id_player)
    {
        // Encontrar la última predicción de puntos asociada a un jugador específico
        $ultimaPrediccion = predicciones_puntos::where('id_player', $id_player)->latest('updated_at')->first();

        // Verificar si se encontró una predicción
        if ($ultimaPrediccion) {
            // Eliminar la última predicción encontrada
            $ultimaPrediccion->delete();
            return response()->json(['message' => 'Última predicción de puntos eliminada correctamente']);
        } else {
            return response()->json(['message' => 'No se encontró ninguna predicción de puntos asociada al jugador especificado'], 404);
        }
    }

    /*  
    *  Eliminar todas las predicciones_de_puntos asociadas a un player 
    *  DELETE api/pred_puntos/player/{id_player}
    */
    public function deleteByPlayer($id_player)
    {
        // Encontrar todas las predicciones de puntos asociadas a un jugador específico
        $predicciones = predicciones_puntos::where('id_player', $id_player)->get();

        // Verificar si se encontraron predicciones
        if ($predicciones->isEmpty()) {
            return response()->json(['message' => 'No se encontraron predicciones de puntos asociadas al jugador especificado'], 404);
        }

        // Eliminar cada una de las predicciones encontradas
        foreach ($predicciones as $prediccion) {
            $prediccion->delete();
        }

        return response()->json(['message' => 'Todas las predicciones de puntos asociadas al jugador han sido eliminadas correctamente']);
    }

    /*  
    *  Eliminar predicción_de_puntos por su id_predicción 
    *  DELETE api/pred_puntos/{id_player}
    */
    public function destroy($id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_puntos::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de puntos no fue encontrada'], 404);
        }

        // Eliminar la predicción
        $prediccion->delete();

        // Devolver una respuesta indicando que la predicción fue eliminada correctamente
        return response()->json(['message' => 'Predicción de puntos eliminada correctamente']);
    }
}
