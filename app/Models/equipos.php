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

    #Reación 1-N con estadísticas_jugaodres
    public function estadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipos::class);
    }

    #Reación 1-N con jugaodres
    public function jugadores()
    {
        return $this->hasMany(Jugadores::class, 'id_equipo', 'id_equipo');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id_equipo');
    }
}
