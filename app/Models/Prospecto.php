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
        'vendedor_anterior',
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
        'Estado_de_integración',
        'Id_Dragón',
        'Id_Analista',
        'UTM_Source',
        'UTM_Content',
        'UTM_Medium',
        'UTM_Campaign',
        'UTM_Term',
        'First_Click',
        'First_Click_Campaign',
        'GCLID',
        'IP_Adress',
        'Device',
        'Operating_System',
        'Browser',
        'First_Click_Content',
        'First_Click_Landing_Page',
        'Time_Zone',
        'City',
        'Country',
        'State',
    ];
}
