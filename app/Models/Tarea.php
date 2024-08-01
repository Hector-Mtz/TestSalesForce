<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'comentarios',
        'mensaje_whats',
        'from_email',
        'to_email',
        'asunto_mail',
        'cuerpo_mail',
        'cat_tareas',
        'prospecto_id',
        'asesor',
    ];
}
