<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticasJornadas extends Model
{
    use HasFactory;

    protected $table = 'estadisticas_jornadas'; // Nombre de la tabla

    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = [
        'id_player',
        'jornada',
        'puntuacion_fantasy',
        'puntuacion_as',
        'puntuacion_marca',
        'puntuacion_mundo_deportivo',
        'media_puntos_visitante',
        'media_puntos_local',
        'valor_mercado',
        'ultimo_rival',
        'resultado_del_partido',
        'proximo_rival',
        'proximo_partido_es_local',
        'balones_en_largo_totales',
        'ocasiones_claras_falladas',
        'tiros_bloqueados_en_defensa',
        'entradas_como_último_hombre',
        'goles_evitados',
        'salidas_precisas',
        'minutos_jugados',
        'goles_esperados',
        'balones_en_largo_precisos',
        'intercepciones',
        'tiros_fuera',
        'tiros_bloqueados_en_ataque',
        'posesiones_perdidas',
        'paradas_desde_dentro_del_área',
        'centros_totales',
        'entradas_totales',
        'despejes_por_alto',
        'duelos_aéreos_perdidos',
        'duelos_ganados',
        'pases_totales',
        'penaltis_cometidos',
        'asistencias_esperadas',
        'pérdidas',
        'regates_totales',
        'penaltis_provocados',
        'despejes_con_los_puños',
        'goles',
        'asistencias_de_gol',
        'tiros_al_palo',
        'regates_completados',
        'ocasiones_creadas',
        'penaltis_fallados',
        'pases_clave',
        'tiros_a_puerta',
        'fueras_de_juego',
        'centros_precisos',
        'errores_que_llevan_a_disparo',
        'despejes_totales',
        'duelos_aéreos_ganados',
        'paradas',
        'pases_precisos',
        'toques',
        'duelos_perdidos',
        'faltas_recibidas',
        'errores_que_llevan_a_gol',
        'salidas_totales',
        'penaltis_parados',
        'regateado',
        'faltas_cometidas',
        'created_at',
        'updated_at',
    ];

    # Relación N-1 con jugadores
    public function jugador()
    {
        return $this->belongsTo(Jugadores::class);
    }
}
