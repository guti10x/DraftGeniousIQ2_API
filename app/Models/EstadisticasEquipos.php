<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticasEquipos extends Model
{
    use HasFactory;

    public function equipo()
    {
        return $this->belongsTo(Equipos::class);
    }
}
