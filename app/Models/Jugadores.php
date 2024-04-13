<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadores extends Model
{
    use HasFactory;
    protected $table = 'jugadores'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_player'; // Nombre de la clave primaria
    
    protected $fillable = [
        'id_equipo',
        'nombre',
        'posicion',
        'equipo',
        'edad',
        'altura',
        'peso',
    ];

    # Relación 1-1 con equipo
    public function equipo()
    {
        return $this->belongsTo(Equipos::class);
    }

    # Relación 1-N con estadísticas_jornada
    public function estadisticasJornadas()
    {
        return $this->hasMany(EstadisticasJornadas::class);
    }

    # Relación N-1 con PrediccionPuntos
    public function prediccionesPuntos()
    {
        return $this->hasMany(Predicciones_puntos::class, 'id_player');
    }

    # Relación n-1 con PrediccionValorMercado
    public function prediccionesValorMercado()
    {
        return $this->hasMany(Predicciones_valor_mercado::class, 'id_player');
    }
}
