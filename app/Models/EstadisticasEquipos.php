<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticasEquipos extends Model
{
    use HasFactory;
    protected $table = 'estadisticas_equipos';
    protected $primaryKey = 'id'; // Especifica el nombre de la columna de la clave primaria
    
    protected $fillable = [
        'id_equipo',
        'puntos',
        'media_puntos_jornada',
        'valor',
        'num_jugadores',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipos::class);
    }
}
