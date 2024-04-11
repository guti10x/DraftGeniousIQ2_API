<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Obtener todos los usuarios y datos asociados a estos almacenados en la base de datos
     * GET api/usuarios
    */
    public function index()
    {
        $usuarios = User::all();
        return response()->json(['usuarios' => $usuarios]);
    }
    
    /**
     * Buscar usuario por su ID y devolver todos los datos almacenados en la bd sobre el usuario encontrado
     * GET api/usuarios/id_usuario_a_obtener_datos     
    */
    public function showById($id)
    {
        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Devolver una respuesta JSON con todos los datos del usuario
        return response()->json(['usuario' => $usuario]);
    }

    /**
     * Buscar usuario por su NOMBRE y devolver todos los datos almacenados en la bd sobre el usuario encontrado
     * GET api/usuarios/id_usuario_a_obtener_datos
    */
    public function showByName($name)
    {
        // Buscar el usuario por su nombre
        $usuario = User::where('name', $name)->first();

        // Verificar si se encontró el usuario
        if ($usuario) {
            // Devolver una respuesta JSON con el usuario encontrado
            return response()->json(['usuario' => $usuario]);
        } else {
            // Devolver una respuesta de error si no se encuentra el usuario
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    /**
     * Obtener todos los usuarios con rol 0 (user app)
     * GET api/usuarios/rol/0
    */
    public function getUsersWithRolZero()
    {
        // Obtener todos los usuarios con rol 0
        $usuarios = User::where('rol', 0)->get();

        // Devolver una respuesta JSON con los usuarios encontrados
        return response()->json(['usuarios' => $usuarios]);
    }

    /**
     * Obtener todos los usuarios con rol 1 (admin)
     * GET api/usuarios/rol/1
    */
    public function getUsersWithRolOne()
    {
        // Obtener todos los usuarios con rol 1
        $usuarios = User::where('rol', 1)->get();

        // Devolver una respuesta JSON con los usuarios encontrados
        return response()->json(['usuarios' => $usuarios]);
    }


    /**
     * //Registrar nuevo usuario en la bd 
     * POST api/usuarios
     * {
     * "name": "nombre_nuevo_usuario",
     * "email": "correo_nuevo_usuario",
     * "password": "contraseña_nuevo_usuario",
     * "rol": rol_nuevo_usuario, (0=user app, 1=admin)
     * "id_team": id_del_equipo_asociado_en_la_tabla_equipos 
     * }
    */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'rol' => 'nullable|integer', // Validación actualizada para aceptar un entero
            'id_team' => 'required|integer',
        ]);

        // Crear el usuario
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
            'id_team' => $request->id_team,
        ]);

        // Devolver una respuesta JSON con el usuario creado y el código de estado 201 (created)
        return response()->json(['usuario' => $usuario], 201);
    }   

}