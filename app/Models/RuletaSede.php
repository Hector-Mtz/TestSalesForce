<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuletaSede extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'nombre',
        'activo',
        'ruleta_general',
        'creado_por',
        'asignaciones',
        'tipo_asignacion',
        'ruleta_padre'
    ];

    public function sedes()
    {
        return $this->hasMany(RuletaSedeSedes::class,'ruleta_sede_id');
    }

    public function productos()
    {
        return $this->hasMany(RuletaSedeProductos::class,'ruleta_sede_id');
    }
}
