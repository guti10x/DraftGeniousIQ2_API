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

    public function equipo()
    {
        return $this->belongsTo(Equipos::class);
    }
}
