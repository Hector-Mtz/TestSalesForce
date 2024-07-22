<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuletaAsesore extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruleta_sede',
        'asignaciones',
        'creado_por',
        'asesor',
        'ultima_asignacion',
        'activo'
    ];
}
