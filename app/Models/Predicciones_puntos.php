<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class predicciones_puntos extends Model
{
    use HasFactory;

    protected $table = 'predicciones_puntos';

    protected $primaryKey = 'id';

    // Relación 1-N con Jugador
    public function jugador()
    {
        return $this->belongsTo(Jugadores::class, 'id_player');
    }
}
