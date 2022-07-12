<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'descripcion',
        'descuento',
    ];

    // Precios has laboratories
    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'precios_has_laboratories');
    }

    // estudios has precios
    public function estudios(){
        return $this->belongsToMany(Estudio::class, 'estudios_has_precios');
    }
}
