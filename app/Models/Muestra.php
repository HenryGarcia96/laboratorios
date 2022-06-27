<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    protected $fillable = [
        'descripcion',
        'observaciones',
    ];
    
    use HasFactory;

    // Laboratorios que crearon muestras
    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'muestras_has_laboratories');
    }
}
