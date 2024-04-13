<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use App\Models\User;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /*
     * Devolver todas las notificaciones almacenadas en la bd
     * GET api/notificaciones
    */
    public function index()
    {
        // Obtener todas las notificaciones
        $notificaciones = Notificaciones::all();
    
        // Devolver una respuesta JSON con todas las notificaciones
        return response()->json(['notificaciones' => $notificaciones]);
    }

    /*
     * Método para devolver todas las notificaciones de un usuario específico por su id_user
     * GET api/notificaciones/id_user/{id_ntf}
    */
    public function getById($id_ntf)
    {
        $notificacion = Notificaciones::find($id_ntf);

        if (!$notificacion) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        return response()->json(['notificacion' => $notificacion], 200);
    }

    /**
     * Método para devolver todas las notificaciones de un usuario específico por su id_user
     * GET api/notificaciones/{id_user}
    */
    public function getByUserId($id_user)
    {
        $notificaciones = Notificaciones::where('id_user', $id_user)->get();
        return response()->json(['notificaciones' => $notificaciones], 200);
    }

    /**
     * Método para devolver todas las notificaciones de un tipo específico por su type
     * GET api/notificaciones/{type}'
    */
    public function getByType($type)
    {
        $notificaciones = Notificaciones::where('type', $type)->get();
        return response()->json(['notificaciones' => $notificaciones], 200);
    }


    /**
     * Almacenar nueva notificación en la bd
     * POST api/notificaciones
    */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id_user' => 'required|integer',
            'type' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        // Crear la notificación
        $notificacion = Notificaciones::create([
            'id_user' => $request->id_user,
            'type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Devolver una respuesta JSON con la notificación creada y el código de estado 201 (creado)
        return response()->json(['notificacion' => $notificacion], 201);
    }

    
    /*
     * Método para actualizar el id_user de una notificación
     * PUT {id_ntf}/updateUserId
    */
    public function updateUserId(Request $request, $id_ntf)
    {
        // Buscar la notificación por su id_ntf
        $notificacion = Notificaciones::find($id_ntf);

        // Verificar si la notificación existe
        if (!$notificacion) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        // Obtener el id_user enviado en la solicitud
        $id_user = $request->input('id_user');

        // Verificar si el id_user existe en la tabla de usuarios
        $userExists = User::where('id', $id_user)->exists();

        // Si el id_user no existe, devolver un mensaje de error
        if (!$userExists) {
            return response()->json(['message' => 'El ID de usuario proporcionado no existe'], 400);
        }

        // Actualizar el id_user de la notificación
        $notificacion->id_user = $id_user;
        $notificacion->save();

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'ID de usuario actualizado correctamente'], 200);
    }

    /* 
     * Método para actualizar el título de una notificación
     * PUT api/notificaciones/{id_ntf}/updateTitle
    */
    public function updateTitle(Request $request, $id_ntf)
    {
        $notificacion = Notificaciones::find($id_ntf);

        if (!$notificacion) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        $notificacion->title = $request->input('title');
        $notificacion->save();

        return response()->json(['message' => 'Título actualizado correctamente'], 200);
    }

    /* 
     * Método para actualizar el contenido de una notificación
     * PUT api/notificaciones/{id_ntf}/updateTitle
    */
    public function updateContent(Request $request, $id_ntf)
    {
        $notificacion = Notificaciones::find($id_ntf);

        if (!$notificacion) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        $notificacion->content = $request->input('content');
        $notificacion->save();

        return response()->json(['message' => 'Contenido actualizado correctamente'], 200);
    }

    /* 
     * Método para actualizar el tipo de una notificación
     *  PUT api/notificaciones/{id_ntf}/updateType
    */
    public function updateType(Request $request, $id_ntf)
    {
        $notificacion = Notificaciones::find($id_ntf);

        if (!$notificacion) {
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        $notificacion->type = $request->input('type');
        $notificacion->save();

        return response()->json(['message' => 'Tipo de notificación actualizado correctamente'], 200);
    }


    /*
     * Eliminar notificación por ID de notificación
     * DELETE /notificaciones/{id}
    */
    public function destroy($id)
    {
        // Buscar la notificación por su ID
        $notificacion = Notificaciones::find($id);

        // Verificar si la notificación existe
        if (!$notificacion) {
            // Si la notificación no existe, devolver un mensaje de error con el código de estado 404 (No encontrado)
            return response()->json(['message' => 'Notificación no encontrada'], 404);
        }

        // Eliminar la notificación
        $notificacion->delete();

        // Devolver un mensaje de éxito con el código de estado 200 (Éxito)
        return response()->json(['message' => 'Notificación eliminada correctamente'], 200);
    }

    /*
     * Eliminar notificación por ID de notificación
     * DELETE /notificaciones/user/{id}
    */
    public function destroyByUserId($id_user)
    {
        // Buscar todas las notificaciones asociadas al id_user
        $notificaciones = Notificaciones::where('id_user', $id_user)->get();

        // Verificar si hay notificaciones asociadas al id_user
        if ($notificaciones->isEmpty()) {
            // Si no hay notificaciones asociadas, devolver un mensaje de error con el código de estado 404 (No encontrado)
            return response()->json(['message' => 'No se encontraron notificaciones asociadas a este usuario'], 404);
        }

        // Eliminar todas las notificaciones asociadas al id_user
        Notificaciones::where('id_user', $id_user)->delete();

        // Devolver un mensaje de éxito con el código de estado 200 (Éxito)
        return response()->json(['message' => 'Todas las notificaciones asociadas al usuario han sido eliminadas correctamente'], 200);
    }

    /*
     * Eliminar notificación por TIPO de notificación
     * DELETE /notificaciones/type/{type}
    */
    public function destroyByType($type)
    {
        // Buscar todas las notificaciones asociadas al tipo
        $notificaciones = Notificaciones::where('type', $type)->get();

        // Verificar si hay notificaciones asociadas al tipo
        if ($notificaciones->isEmpty()) {
            // Si no hay notificaciones asociadas, devolver un mensaje de error con el código de estado 404 (No encontrado)
            return response()->json(['message' => 'No se encontraron notificaciones asociadas a este tipo'], 404);
        }

        // Eliminar todas las notificaciones asociadas al tipo
        Notificaciones::where('type', $type)->delete();

        // Devolver un mensaje de éxito con el código de estado 200 (Éxito)
        return response()->json(['message' => 'Todas las notificaciones asociadas al tipo han sido eliminadas correctamente'], 200);
    }

}