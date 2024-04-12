<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $primaryKey = 'id_ntf'; // Actualizamos el nombre de la clave primaria

    protected $fillable = [
        'id_user',
        'type',
        'title',
        'content',
        'creation_date',
    ];

    #Relación 1-N con user
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
