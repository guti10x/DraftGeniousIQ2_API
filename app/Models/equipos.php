<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo'; // Especifica el nombre de la columna de la clave primaria
    protected $fillable = ['nombre'];

    # Relación 1-N con estadísticas_equipos
    public function estadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipos::class);
    }

    # Relación 1-N con jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugadores::class, 'id_equipo', 'id_equipo');
    }
    # Relación 1-N con usuarios
    public function usuario()
    {
        return $this->hasOne(User::class, 'id_equipo');
    }
}
