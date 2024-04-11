<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquiposController;
use App\Http\Controllers\EstadisticasEquiposController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\EstadisticasJornadasController;
use App\Http\Controllers\UsuariosController;

# EQUIPOS:
Route::get('/equipos', [EquiposController::class, 'index']); // Obtener todos los equipos
Route::get('/equipos/{equipo}', [EquiposController::class, 'getNameById']); // Obtener NAME de un equipo por su ID
Route::get('/equipos/id/{nombre}', [EquiposController::class, 'getIdByName']);// Obtener ID de un equipo por su NAME
Route::post('/equipos', [EquiposController::class, 'store']); // Crear un nuevo equipo pasándole su nombre
Route::delete('/equipos/{id}', [EquiposController::class, 'destroy']); //Eliminar un equipo
Route::put('/equipos/{equipos}', [EquiposController::class, 'update']); //Actualizar nombre d eun equipo

# ESTADÍSTICAS_EQUIPOS:
Route::get('/estadisticas-equipos', [EstadisticasEquiposController::class, 'index']); //Obtener TODAS las estadísticas de todos los equipos
Route::get('/estadisticas-equipos/{id}/stats', [EstadisticasEquiposController::class, 'getStatsById']); //Obtener TODAS las estadísticas asociadas a un ID de un equipo
Route::get('/estadisticas-equipos/{id}/last-stats', [EstadisticasEquiposController::class, 'getLastStatsById']); //Obtener ÚLTIMA estadística asociada a un ID de un equipo
Route::post('/estadisticas-equipos', [EstadisticasEquiposController::class, 'store']); // Crear una nueva estadítica asociada un equipo
Route::put('/estadisticas-equipos/{id}', [EstadisticasEquiposController::class, 'update']); //Actualizar el valor de todas las estadísticas de un equipo
Route::put('/estadisticas-equipos/{id}/id-equipo', [EstadisticasEquiposController::class, 'updateIdEquipo']); // Actualizar id_equipo asociado a una estadística de un equipo
Route::put('/estadisticas-equipos/{id}/puntos', [EstadisticasEquiposController::class, 'updatePuntos']); // Actualizar puntos obtenidos en una jornada un equipo
Route::put('/estadisticas-equipos/{id}/media-puntos-jornada', [EstadisticasEquiposController::class, 'updateMediaPuntosJornada']); // Actualizar media de puntos de un equipo
Route::put('/estadisticas-equipos/{id}/valor', [EstadisticasEquiposController::class, 'updateValor']); // Actualizar valor de un equipo
Route::put('/estadisticas-equipos/{id}/num-jugadores', [EstadisticasEquiposController::class, 'updateNumJugadores']); // Actualizar número de jugadores de un equipo
Route::delete('/estadisticas-equipos/{id_equipo}/all', [EstadisticasEquiposController::class, 'destroyAllStatsByTeamId']); // Eliminar todas las estadísticas asociadas a un equipo por su ID

#EQUIPOS - ESTADÍSTICAS_EQUIPOS:
Route::get('/equipos/{equipo}/estadisticas', [EstadisticasEquiposController::class, 'index']); //Obtener TODAS las estadísticas asociadas a un equipo por su id
Route::get('/equipos/{equipo}/estadisticas/last-stats', [EstadisticasEquiposController::class, 'getLastStatsById']); //Obtener la ÚLTIMA estadística asociada a un equipo por su id


#JUGADORES
Route::get('/jugadores', [JugadoresController::class, 'index']); //Obtener todas las estadísticas globales de un jugador
Route::get('/jugadores/{id}/nombre-posicion-equipo', [JugadoresController::class, 'getNombrePosicionEquipo']); //Obtener jugador por su ID y devolver nombre, posición y equipo.
Route::get('/jugadores/{id}/edad-altura-peso', [JugadoresController::class, 'getEdadAlturaPeso']);  //Buscar jugador por su ID y devolver edad, altura y peso.
Route::get('/equipos/{id_equipo}/jugadores', [JugadoresController::class, 'jugadoresPorIDEquipo']);
Route::get('/jugadores/por-posicion/{posicion}', [JugadoresController::class, 'jugadoresPorPosicion']);
Route::get('/jugadores/por-equipo/{equipo}', [JugadoresController::class, 'jugadoresPorEquipo']);
Route::post('/jugadores', [JugadoresController::class, 'store']); //Añadir a la tabla jugadores un nuevo jugador con sus estadísticas globales asociadas
Route::put('/jugadores/{jugadores}', [JugadoresController::class, 'update']); // Actualiza el conjunto de atributos globales asociados a un jugador
Route::put('/jugadores/{jugador}/id_jugador  ', [JugadoresController::class, 'updateIdEquipo']); // Actualizar el ID del equipo asociado a un jugador
Route::put('/jugadores/{jugador}/nombre', [JugadoresController::class, 'updateName']); // Actualiza el nombre de un jugador
Route::put('/jugadores/{jugador}/posicion', [JugadoresController::class, 'updatePosition']); // Actualiza la posición de un jugador
Route::put('/jugadores/{jugador}/equipo', [JugadoresController::class, 'updateTeam']); // Actualiza el equipo de un jugador
Route::put('/jugadores/{jugador}/edad', [JugadoresController::class, 'updateAge']); // Actualiza la edad de un jugador
Route::put('/jugadores/{jugador}/altura', [JugadoresController::class, 'updateHeight']); // Actualiza la altura de un jugador
Route::put('/jugadores/{jugador}/peso', [JugadoresController::class, 'updateWeight']); // Actualiza el peso de un jugador
Route::delete('/jugadores/{id}', [JugadoresController::class, 'destroy']); //Eliminar un jugador por su id

#ESTADÍSTICAS JORNADA
Route::get('/estadisticas-jornadas', [EstadisticasJornadasController::class, 'index']); //Obtener TODAS las estadísticas asociadas a TODOS los jugadores
Route::get('estadisticas-jornadas/{id}/estadisticas', [EstadisticasJornadasController::class, 'mostrarTodasEstadisticasJugador']); //Obtener todas las últimas estadísticas (las más recientes), asociadas al id de un jugador que NO son nulas
Route::post('/estadisticas-jornadas', [EstadisticasJornadasController::class, 'store']); //Añadir a la tabla estadisticas_jugadores una nueva estadística asociada un jugador y jornada.

#USERS
Route::get('/usuarios', [UsuariosController::class, 'index']); //Obtener todos los usuarios y datos asociados a estos almacenados en la base de datos
Route::post('/usuarios', [UsuariosController::class, 'store']); //Registrar nuevo usuario en la bd 
Route::get('/usuarios/{id}', [UsuariosController::class, 'showById']); // Devolver datos de un usuarios buscado en la bd por su nombre
Route::get('/usuarios/nombre/{name}', [UsuariosController::class, 'showByName']); //Devolver datos de un usuarios buscado en la bd por su nombre
Route::get('/usuarios/rol/1', [UsuariosController::class, 'getUsersWithRolOne']); //Obtener todos los usuarios con rol 1 (admin)
Route::get('/usuarios/rol/0', [UsuariosController::class, 'getUsersWithRolZero']); //Obtener todos los usuarios con rol 0 (user app)
Route::put('/usuarios/{id}/actualizar-nombre', [UsuariosController::class, 'updateName']); // Actualizar el nombre del usuario
Route::put('/usuarios/{id}/actualizar-email', [UsuariosController::class, 'updateEmail']); // Actualizar el correo electrónico del usuario
Route::put('/usuarios/{id}/actualizar-password', [UsuariosController::class, 'updatePassword']); // Actualizar la contraseña del usuario
Route::put('/usuarios/{id}/actualizar-id-equipo', [UsuariosController::class, 'updateTeamId']); //Actualizar el ID del equipo del usuario
Route::put('/usuarios/{id}/actualizar-rol', [UsuariosController::class, 'updateRole']); //Actualizar el rol del usuario
Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy']); //Eliminar usuario por id