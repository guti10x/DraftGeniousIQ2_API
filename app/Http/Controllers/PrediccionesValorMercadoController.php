<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use App\Models\predicciones_valor_mercado;
use Illuminate\Http\Request;

class PrediccionesValorMercadoController extends Controller
{
    /* Obtener todas las predicciones_de_valor_de_mercado almacenadas en la bd
    *  GET api/pred_valor
    */
    public function index()
    {
        // Obtener todas las predicciones de valor de mercado almacenadas en la bd
        $predicciones = predicciones_valor_mercado::all();

        // Devolver las predicciones como respuesta en formato JSON
        return response()->json(['predicciones_valor_mercado' => $predicciones]);
    }

    /*
    * Obtener TODAS las predicciones_de_valor_de_mercado asociadas a un player
    * GET api/pred_valor/player/{id_player}
    */
    public function getByPlayer($id_player)
    {
        // Obtener todas las predicciones de valor de mercado asociadas a un jugador específico
        $predicciones = predicciones_valor_mercado::where('id_player', $id_player)->get();

        // Devolver las predicciones como respuesta en formato JSON
        return response()->json(['predicciones_valor_mercado' => $predicciones]);
    }

    /*
    * Obtener LA ÚLTIMA predicción_de_valor_de_mercado asociada a un player
    * GET api/pred_valor/player/{id_player}/last
    */
    public function getLastByPlayer($id_player)
    {
        // Obtener la última predicción de valor de mercado asociada a un jugador específico, ordenada por updated_at
        $ultimaPrediccion = predicciones_valor_mercado::where('id_player', $id_player)->latest('updated_at')->first();

        // Devolver la última predicción como respuesta en formato JSON
        return response()->json(['ultim0_valor_mercado' => $ultimaPrediccion]);
    }


    /*
     * Almacenar nueva predicción_de_valor_de_mercado  asociada a un jugador
     * STORE api/pred_valor
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

        // Crear una nueva predicción de valor de mercado con los datos recibidos
        $prediccion = predicciones_valor_mercado::create([
            'id_player' => $request->id_player,
            'valor' => $request->valor,
        ]);

        // Devolver una respuesta JSON con la nueva predicción creada y el código de estado 201 (creado)
        return response()->json(['prediccion_valor_de_mercado' => $prediccion], 201);
    }


    /* 
     * Modificar id_player asociado a la predicción_de_valor_de_mercado por id de la predicción
     * PUT api/pred_valor/{id_prediccion}/update_player
    */
    public function updatePlayer(Request $request, $id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_valor_mercado::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de valor de mercado no fue encontrada'], 404);
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
        return response()->json(['message' => 'ID del jugador asociado a la predicción de valor de mercado actualizado correctamente']);
    }

    /* 
     * Modificar valor de la predicción_de_valor_de_mercado por id de la predicción
     * PUT api/pred_valor/{id_prediccion}/update_value
    */
    public function updateValue(Request $request, $id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_valor_mercado::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de valor de mercado no fue encontrada'], 404);
        }

        // Validar los datos recibidos en la petición
        $request->validate([
            'valor' => 'required|numeric',
        ]);

        // Actualizar el valor de la predicción
        $prediccion->valor = $request->valor;
        $prediccion->save();

        // Devolver una respuesta indicando que la predicción fue modificada correctamente
        return response()->json(['message' => 'Valor de la predicción de valor de mercado actualizado correctamente']);
    }


    /*  
    *  Eliminar ultima predicción_de_valor_de_mercado asociada a un player 
    *  DELETE api/pred_valor/player/{id_player}/last
    */
    public function deleteLastByPlayer($id_player)
    {
        // Encontrar la última predicción de valor de mercado asociada a un jugador específico
        $ultimaPrediccion = predicciones_valor_mercado::where('id_player', $id_player)->latest('updated_at')->first();

        // Verificar si se encontró una predicción
        if ($ultimaPrediccion) {
            // Eliminar la última predicción encontrada
            $ultimaPrediccion->delete();
            return response()->json(['message' => 'Última predicción de valor de mercado eliminada correctamente']);
        } else {
            return response()->json(['message' => 'No se encontró ninguna predicción de valor de mercado asociada al jugador especificado'], 404);
        }
    }

    /*  
    *  Eliminar todas las predicción_de_valor_de_mercado asociadas a un player 
    *  DELETE api/pred_valor/player/{id_player}
    */
    public function deleteByPlayer($id_player)
    {
        // Encontrar todas las predicciones de valor de mercado asociadas a un jugador específico
        $predicciones = predicciones_valor_mercado::where('id_player', $id_player)->get();

        // Verificar si se encontraron predicciones
        if ($predicciones->isEmpty()) {
            return response()->json(['message' => 'No se encontraron predicciones de valor de mercado asociadas al jugador especificado'], 404);
        }

        // Eliminar cada una de las predicciones encontradas
        foreach ($predicciones as $prediccion) {
            $prediccion->delete();
        }

        return response()->json(['message' => 'Todas las predicciones de valor de mercado asociadas al jugador han sido eliminadas correctamente']);
    }

    /*  
    *  Eliminar predicción_de_valor_de_mercado por su id_predicción 
    *  DELETE api/pred_valor/{id_player}
    */
    public function destroy($id_prediccion)
    {
        // Buscar la predicción por su ID
        $prediccion = predicciones_valor_mercado::find($id_prediccion);

        // Verificar si la predicción existe
        if (!$prediccion) {
            return response()->json(['message' => 'La predicción de valor de mercado no fue encontrada'], 404);
        }

        // Eliminar la predicción
        $prediccion->delete();

        // Devolver una respuesta indicando que la predicción fue eliminada correctamente
        return response()->json(['message' => 'Predicción de valor de mercado eliminada correctamente']);
    }
   
}
