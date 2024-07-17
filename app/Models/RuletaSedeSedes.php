<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuletaSedeSedes extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'ruleta_sede_id',
        'sede_id',
    ];
}
