<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipos extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_equipo'; // Especifica el nombre de la columna de la clave primaria
}
