<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovedadesAplicacion extends Model
{
    use HasFactory;

    // Especifica la tabla asociada al modelo
    protected $table = 'novedades_app';

    // Especifica la clave primaria de la tabla
    protected $primaryKey = 'id_novedad';

    // Desactiva las marcas de tiempo automáticas de Laravel
    public $timestamps = false;

    // Especifica los campos que se pueden asignar en masa
    protected $fillable = [
        'titulo',
        'subtitulo',
        'img',
        'created_at',
        'update_at'
    ];

    // Define los tipos de datos de los campos
    protected $casts = [
        'created_at' => 'date',
        'update_at' => 'date'
    ];
}