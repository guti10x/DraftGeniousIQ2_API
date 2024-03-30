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
Route::post('/equipos', [EquiposController::class, 'store']); // Crear un nuevo equipo pasandole su nombre
Route::delete('/equipos/{id}', [EquiposController::class, 'destroy']);
Route::put('/equipos/{equipos}', [EquiposController::class, 'update']);

# ESTADíSTICAS_EQUIPOS:
//Obtener TODAS las estadísticas de todos los equipos
Route::get('/estadisticas-equipos', [EstadisticasEquiposController::class, 'index']);
//Obtener TODAS las estadísticas asociadas a un ID de un equipo
Route::get('/estadisticas-equipos/{id}/stats', [EstadisticasEquiposController::class, 'getStatsById']);
//Obtener ÚLTIMA estadística asociada a un ID de un equipo
Route::get('/estadisticas-equipos/{id}/last-stats', [EstadisticasEquiposController::class, 'getLastStatsById']);

#EQUIPOS - ESTADíSTICAS_EQUIPOS:
Route::get('/equipos/{equipo}/estadisticas', [EstadisticasEquiposController::class, 'index']);