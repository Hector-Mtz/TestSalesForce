<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuletaGeneral extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nombre',
        'sede',
        'creado_por',
        'activo'
    ];
    
    public function ruletas_hijo()
    {
        return $this->hasMany(RuletaSede::class,'ruleta_general');
    }
}
