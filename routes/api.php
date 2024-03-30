<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquiposController;
use App\Http\Controllers\EstadisticasEquiposController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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

#EQUIPOS - ESTADíSTICAS_EQUIPOS:
Route::get('/equipos/{equipo}/estadisticas', [EstadisticasEquiposController::class, 'index']); //Obtener TODAS las estadísticas asociadas a un equipo por su id