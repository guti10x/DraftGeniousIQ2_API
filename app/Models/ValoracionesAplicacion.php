<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValoracionesAplicacion extends Model
{
    use HasFactory;

    // Especifica la tabla asociada al modelo
    protected $table = 'valoraciones_app';

    // Especifica la clave primaria de la tabla
    protected $primaryKey = 'id_valoration';

    // Desactiva las marcas de tiempo automáticas de Laravel
    public $timestamps = false;

    // Especifica los campos que se pueden asignar en masa
    protected $fillable = [
        'id_usuario',
        'nombre_resenador',
        'titulo',
        'contenido',
        'rating',
        'created_at',
        'updated_at'
    ];

    // Define los tipos de datos de los campos
    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date'
    ];
}