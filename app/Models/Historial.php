<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable = [
        'clave',
        'descripcion',
        'valor',
        'estatus',
        'entrega',
    ];

    use HasFactory;

    // historial has estudios
    public function estudios(){
        return $this->belongsToMany(Estudio::class, 'historials_has_estudios')->withPivot('analito_id');
    }
}
