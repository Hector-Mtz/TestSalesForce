<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'activo',
        'mensaje',
        'propietario',
        'vendedor anterior',
        'asignacion',
        'sede',
        'tipo_prospecto',
        'status',
        'producto_de_interes',
        'campana_canal',
        'origen',
        'monto_enganche',
        'forma_contacto',
        'horario_contacto',
        'busqueda_terreno',
        'inversion_al_mes',
        'idioma',
        'Estado de integración',
        'Id Dragón',
        'Id Analista',
        'UTM Source',
        'UTM Content',
        'UTM Medium',
        'UTM Campaign',
        'UTM Term',
        'First Click',
        'First Click Campaign',
        'GCLID',
        'IP Adress',
        'Device',
        'Operating System',
        'Browser',
        'First Click Content',
        'First Click Landing Page',
        'Time Zone',
        'City',
        'Country',
        'State',
    ];
}
