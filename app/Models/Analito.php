<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analito extends Model
{
    protected $fillable = [
        'clave',
        'descripcion',
        'bitacora',
        'defecto',
        'unidad',
        'digito',
        'tipo_resultado',

        'referencia',
        'check_validacion',

        'numero_uno',
        'numero_dos',

        'valor_referencia',
        'documento',
        'imagen'
    ];

    use HasFactory;

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'analitos_has_laboratories');
    }

    // Registra referencia al analito
    public function referencias(){
        return $this->belongsToMany(Referencia::class, 'referencias_has_analitos');
    }

    // analitos_has_estudios
    public function estudios(){
        return $this->belongsToMany(Estudio::class, 'analitos_has_estudios');
    }
}
