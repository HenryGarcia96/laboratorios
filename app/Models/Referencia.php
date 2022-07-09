<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $fillable = [
        'edad_inicial',
        'tipo_inicial',
        'edad_final',
        'tipo_final',
        'sexo',
        'referencia_inicial',
        'referencia_final',
        'dias_inicio',
        'dias_final'
    ];
    use HasFactory;

    // Registra referencia al analito
    public function analitos(){
        return $this->belongsToMany(Analito::class, 'referencias_has_analitos');
    }
}
