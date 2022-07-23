<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable = [
        'clave',
        'historial_id',
        'descripcion',
        'valor',
        'estatus',
        'entrega',
    ];

    use HasFactory;

    // historial has estudios
    public function recepcions(){
        return $this->belongsToMany(Recepcions::class, 'historials_has_recepcions');
    }
}
