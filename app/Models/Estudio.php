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
    // Laboratorios del estudio
    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'estudios_has_laboratories');
    }
    
    // // Guardar estudios con datos de las otras secciones
    // public function laboratorio(){
    //     return $this->belongsToMany(Laboratory::class, 'estudios_has_laboratories')->withPivot();
    // }
    // // 
    // public function area(){
    //     return $this->belongsToMany(Area::class, 'estudios_has_laboratories')->withPivot();
    // }
    // // 
    // public function muestra(){
    //     return $this->belongsToMany(Muestra::class, 'estudios_has_laboratories')->withPivot();
    // }
    // // 
    // public function metodo(){
    //     return $this->belongsToMany(Metodo::class, 'estudios_has_laboratories')->withPivot();
    // }
    // // 
    // public function tecnica(){
    //     return $this->belongsToMany(Tenica::class, 'estudios_has_laboratories')->withPivot();
    // }

    // analitos_has_estudios
    public function analitos(){
        return $this->belongsToMany(Analito::class, 'analitos_has_estudios');
    }

    // Precios has estudios
    public function precios(){
        return $this->belongsToMany(Precio::class, 'estudios_has_precios');
    }
}
