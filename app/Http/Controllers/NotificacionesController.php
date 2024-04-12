<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
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

    /**
     * Store a newly created resource in storage.
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


    /**
     * Display the specified resource.
     */
    public function show(Notificaciones $notificaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificaciones $notificaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificaciones $notificaciones)
    {
        //
    }
}