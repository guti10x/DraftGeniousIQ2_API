<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquiposController;
use App\Http\Controllers\EstadisticasEquiposController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\EstadisticasJornadasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\PrediccionesPuntosController;
use App\Http\Controllers\PrediccionesValorMercadoController;
use App\Models\predicciones_valor_mercado;

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
Route::get('/equipos/{id_equipo}/jugadores', [JugadoresController::class, 'jugadoresPorIDEquipo']); // Obtener todos los jugadores que pertenecen a un equipo por su id_equipo asociado
Route::get('/jugadores/por-posiciones/{posicion}', [JugadoresController::class, 'jugadoresPorPosicion']);  //Obtener todos los jugadores de juegan en la misma posición 
Route::get('/equipos/{idEquipo}/jugadores/{posicion}', [JugadoresController::class, 'obtenerJugadoresTitularesPorPosicion']);//Obtener todos los jugadores TITULARES que juegan en una misma posición de un equipo
Route::get('/jugadores/por-equipo/{equipo}', [JugadoresController::class, 'jugadoresPorEquipo']); //Obtener todos los jugadores que pertenecen al mismo equipo de LaLiga
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

#NOTIFICACIONES
Route::get('/notificaciones', [NotificacionesController::class, 'index']); //Devolver todas las notificaciones almacenadas en la bd
Route::get('/notificaciones/{id_ntf}', [NotificacionesController::class, 'getById']); // Obtener notificación por ID
Route::get('/notificaciones/user/{id_user}', [NotificacionesController::class, 'getByUserId']); // Obtener todas las notificaciones de un usuario por su id_user
Route::get('/notificaciones/type/{type}', [NotificacionesController::class, 'getByType']); // Obtener todas las notificaciones de un tipo específico por su type
Route::post('/notificaciones', [NotificacionesController::class, 'store']); //Almacenar nueva notificación en la bd
Route::put('/notificaciones/{id_ntf}/updateUserId', [NotificacionesController::class, 'updateUserId']); // Actualizar el id_user de una notificación
Route::put('/notificaciones/{id_ntf}/updateTitle', [NotificacionesController::class, 'updateTitle']); // Actualizar el título de una notificación
Route::put('/notificaciones/{id_ntf}/updateContent', [NotificacionesController::class, 'updateContent']); // Actualizar el contenido de una notificación
Route::put('/notificaciones/{id_ntf}/updateType', [NotificacionesController::class, 'updateType']); // Actualizar el tipo de una notificación
Route::delete('/notificaciones/{id}', [NotificacionesController::class, 'destroy']); //Eliminar notificación por ID_notificación
Route::delete('/notificaciones/user/{id_user}', [NotificacionesController::class, 'destroyByUserId']); //Eliminar notificación por ID_user
Route::delete('/notificaciones/type/{type}', [NotificacionesController::class, 'destroyByType']); //Eliminar por tipo de notificación

#PREDICCIONES PUNTOS
Route::get('/pred_puntos', [PrediccionesPuntosController::class, 'index']); //Obtener todas las predicciones_de_puntos almacenadas en la bd
Route::get('/pred_puntos/player/{id_player}', [PrediccionesPuntosController::class, 'getByPlayer']); //Obtener TODAS las predicciones_de_puntos asociadas a un player
Route::get('/pred_puntos/player/{id_player}/last', [PrediccionesPuntosController::class, 'getLastByPlayer']); //Obtener LA ÚLTIMA predicción_de_puntos asociada a un player
Route::post('/pred_puntos', [PrediccionesPuntosController::class, 'store']); // Almacenar nueva predicción_de_puntos asociada a un jugador
Route::put('/pred_puntos/{id_prediccion}/update_player', [PrediccionesPuntosController::class, 'updatePlayer']);  // Modificar id_player asociado a la predicción_de_puntos por id de la predicción
Route::put('/pred_puntos/{id_prediccion}/update_value', [PrediccionesPuntosController::class, 'updateValue']);  // Modificar valor de la predicción_de_puntos por id de la predicción
Route::delete('/pred_puntos/{id_prediccion}', [PrediccionesPuntosController::class, 'destroy']);  // Eliminar predicción_de_puntos por su id_predicción 
Route::delete('/pred_puntos/player/{id_player}/last', [PrediccionesPuntosController::class, 'deleteLastByPlayer']); // Eliminar ultima predicción_de_puntos asociada a un player 
Route::delete('/pred_puntos/player/{id_player}', [PrediccionesPuntosController::class, 'deleteByPlayer']); // Eliminar todas las predicciones_de_puntos asociadas a un player 

#PREDICCIONES VALOR DE MERCADO
Route::get('/pred_valor', [PrediccionesValorMercadoController::class, 'index']);  // Obtener todas las predicciones_de_valor_de_mercado almacenadas en la bd
Route::get('/pred_valor/player/{id_player}', [PrediccionesValorMercadoController::class, 'getByPlayer']);// Obtener TODAS las predicciones_de_valor_de_mercado asociadas a un player
Route::get('/pred_valor/player/{id_player}/last', [PrediccionesValorMercadoController::class, 'getLastByPlayer']);// Obtener LA ÚLTIMA predicción_de_valor_de_mercado asociada a un player
Route::post('/pred_valor', [PrediccionesValorMercadoController::class, 'store']);// Almacenar nueva predicción_de_valor_de_mercado asociada a un jugador
Route::put('/pred_valor/{id_prediccion}/update_player', [PrediccionesValorMercadoController::class, 'updatePlayer']);// Modificar id_user asociado_de_valor_de_mercado a la predicción por id_predicción
Route::put('/pred_valor/{id_prediccion}/update_value', [PrediccionesValorMercadoController::class, 'updateValue']);// Modificar valor de la predicción_de_valor_de_mercado por id_predicción
Route::delete('/pred_valor/{id_prediccion}', [PrediccionesValorMercadoController::class, 'destroy']);  // Eliminar predicción_de_valor_de_mercado por su id_predicción 
Route::delete('/pred_valor/player/{id_player}/last', [PrediccionesValorMercadoController::class, 'deleteLastByPlayer']);  // Eliminar ultima predicción_de_valor_de_mercado asociada a un player 
Route::delete('/pred_valor/player/{id_player}', [PrediccionesValorMercadoController::class, 'deleteByPlayer']);  // Eliminar todas las predicciones_de_valor_de_mercado asociadas a un player 