<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partidos';

    protected $primaryKey = 'id_partido';

    protected $fillable = [
        'jornada',
        'equipo_local',
        'equipo_visitante',
        'goles_local',
        'goles_visitante',
    ];

}