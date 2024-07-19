<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuletaSedeProductos extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'ruleta_sede_id',
        'producto_id',
        'activo'
    ];
}
