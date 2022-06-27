<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipiente extends Model
{
    protected $fillable = [
        'descripcion',
        'marca',
        'capacidad',
        'presentacion',
        'unidad_medida',
        'observaciones',
    ];
    
    use HasFactory;

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'recipientes_has_laboratories');
    }
}
