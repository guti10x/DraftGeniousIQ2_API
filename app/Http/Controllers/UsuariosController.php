<?php

namespace App\Http\Controllers;

use App\Models\equipos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    /**
     * Obtener todos los usuarios y datos asociados a estos almacenados en la base de datos
     * GET api/usuarios
    */
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }
    
    /**
     * Buscar usuario por su ID y devolver todos los datos almacenados en la bd sobre el usuario encontrado
     * GET api/usuarios/{id_usuario_a_obtener_datos}     
    */
    public function showById($id)
    {
        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Devolver una respuesta JSON con los datos del usuario directamente
        return response()->json($usuario);
    }

    /**
     * Buscar usuario por su NOMBRE y devolver todos los datos almacenados en la bd sobre el usuario encontrado
     * GET api/usuarios/{id_usuario_a_obtener_datos}
     * EJ:http://127.0.0.1:8000/api/usuarios/nombre/guti10x_
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
     * Buscar usuario por su EMAIL y devolver su ID
     * GET api/usuarios/{email_usuario_a_obtener_id}
     */
    public function getIdByEmail($email)
    {
        // Buscar el usuario por su email
        $usuario = User::where('email', $email)->first();   

        // Verificar si se encontró el usuario
        if ($usuario) {
            // Devolver el ID del usuario encontrado
            return response()->json($usuario->id);
        } else {
            // Devolver una respuesta de error si no se encuentra el usuario
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    /**
     * Buscar usuario por su EMAIL y devolver su ID
     * GET api/usuarios/{email_usuario_a_obtener_id}
     * EJ: http://127.0.0.1:8000/api/usuarios/email_verified/gt104515@gmail.com
     */
    public function emailVerificado($email)
    {
        // Buscar el usuario por su email y seleccionar el campo email_verified
        $usuario = User::where('email', $email)->first(['email_verified']);   
    
        // Verificar si se encontró el usuario
        if ($usuario) {
            // Devolver el valor de email_verified del usuario encontrado
            return response()->json($usuario->email_verified);
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
     * Obtener el rol asociado al email de un usuario
     * Ej: http://127.0.0.1:8000/api/user/role
     * {
     *     "email":"gt104515@gmail.com"
     * }   
    */
    public function getRoleByEmail(Request $request)
    {
        // Validar el correo electrónico proporcionado
        $request->validate([
            'email' => 'required|email',
        ]);

        // Buscar al usuario por su correo electrónico
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Si se encuentra al usuario, devolver su rol
            return response()->json($user->rol);
        } else {
            // Si no se encuentra al usuario, devolver un mensaje de error
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }


    /**
     * Registrar nuevo usuario en la bd 
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
            'rol' => 'nullable|integer|in:0,1', // El rol solo puede ser 0 o 1
            'id_team' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    // Verificar si el ID de equipo existe en la tabla equipos
                    if (!Equipos::where('id_equipo', $value)->exists()) {
                        $fail('El ID del equipo no existe.');
                    }
                },
            ],
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

    /**
     * Actualizar el nombre del usuario.
     * PUT api/usuarios/{id_usuario_nombre_a_actualizar}/actualizar-nombre
     * {
     *    "name": "nombre_actualizado",
     * }
    */
    public function updateName(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string',
        ]);

        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Actualizar el nombre del usuario
        $usuario->name = $request->name;
        $usuario->save();

        // Devolver una respuesta JSON con el usuario actualizado
        return response()->json(['usuario' => $usuario]);
    }

    /**
     * Actualizar el correo electrónico del usuario.
     * PUT api/usuarios/{id_usuario_nombre_a_actualizar}/actualizar-email
     * {
     * "email": "correo_actualizado"
     * }
    */
    public function updateEmail(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^.+@.+\..+$/i', // Asegura que el correo electrónico contenga un '@'
                Rule::unique('users')->ignore($id),
            ],
        ]);

        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Actualizar el correo electrónico del usuario
        $usuario->email = $request->email;
        $usuario->save();

        // Devolver una respuesta JSON con el usuario actualizado
        return response()->json(['usuario' => $usuario]);
    }

    /**
     * Actualizar la contraseña del usuario.
     * PUT api/usuarios/{id_usuario_nombre_a_actualizar}/actualizar-password
     * {
     * "email": "contraseña_actualizada"
     * }
    */
    public function updatePassword(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'password' => 'required|string',
        ]);

        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Actualizar la contraseña del usuario
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        // Devolver una respuesta JSON con el usuario actualizado
        return response()->json(['usuario' => $usuario]);
    }

    /**
     * Actualizar el ID del equipo del usuario.
     * PUT api/usuarios/{id_usuario_nombre_a_actualizar}/actualizar-id-equipo
     * {
     * "email": "id_equipo_asociado_actualizado"
     * }
    */
    public function updateTeamId(Request $request, $id)
    {
        // Validar que el id del equipo al que se quiere actualizar existe en la tabla equipo
        $request->validate([
            'id_team' => 'required|exists:equipos,id_equipo',
        ]);
    
        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);
    
        // Actualizar el ID del equipo del usuario
        $usuario->id_team = $request->id_team;
        $usuario->save();
    
        // Devolver una respuesta JSON con el usuario actualizado
        return response()->json(['usuario' => $usuario]);
    }

    /**
     * Actualizar el rol del usuario.
     * PUT api/usuarios/{id_usuario_nombre_a_actualizar}/actualizar-rol
     * {
     * "id_team": rol_actualizado_entre_0_y_1
     * }
    */
    public function updateRole(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'rol' => 'required|in:0,1',
        ]);

        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Actualizar el rol del usuario solo si el valor es 0 o 1
        if ($request->rol == 0 || $request->rol == 1) {
            $usuario->rol = $request->rol;
            $usuario->save();

            // Devolver una respuesta JSON con el usuario actualizado
            return response()->json(['usuario' => $usuario]);
        } else {
            // Devolver una respuesta de error si el valor no es 0 ni 1
            return response()->json(['error' => 'El valor de rol debe ser 0 o 1'], 422);
        }
    }

    /**
     * Eliminar un usuario por su ID.
     * DELETE /usuarios/{id_user_a_eliminar
     */
    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Eliminar el usuario
        $usuario->delete();

        // Devolver una respuesta JSON con un mensaje de éxito
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

}