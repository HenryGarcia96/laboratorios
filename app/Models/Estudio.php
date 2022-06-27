<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    protected $fillable = [
        'clave',
        'codigo',
        'descripcion',
        'condiciones',
        'aplicaciones',
        'dias_proceso'
    ];

    use HasFactory;
}
