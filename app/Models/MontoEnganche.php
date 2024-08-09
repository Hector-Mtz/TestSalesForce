<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontoEnganche extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'cantidad',
        'activo'
    ];
}
