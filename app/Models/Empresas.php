<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;
    public $fillable = ['clave','descripcion','calle',
                        'colonia','ciudad','telefono',
                        'rfc','email','contacto',
                        'descuento','usuario','password'];


    public function recepcions(){
        return $this->hasMany(Recepcions::class, 'id'); 
    }
    
    public function laboratory(){
        return $this->belongsToMany(Laboratory::class, 'empresas_has_laboratories');
    }
    public function pacientes(){
        return $this->hasMany(Pacientes::class, 'id'); 
    }                    
}
