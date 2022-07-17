<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable = [
        'data',
        'estatus',
        'entrega',
    ];

    use HasFactory;


    // historial has analitos
    public function analitos(){
        return $this->belongsToMany(Analito::class, 'historials_has_analitos');
    }
}
