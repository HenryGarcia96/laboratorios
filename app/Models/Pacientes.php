<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    public $fillable = ['nombre', 'ap_paterno', 'ap_materno',
                        'domocilio', 'colonia', 'sexo', 'fecha_nacimiento',
                        'celular', 'email', 'empresa', 'seguro_popular',
                        'vigencia_inicio', 'vigencia_fin', 'usuario',
                        'password']; 



    public function laboratory(){
        return $this->belongsToMany(Laboratory::class, 'pacientes_has_laboratories');
    }
    
    public function recepcions(){
        return $this->hasMany(Recepcions::class, 'id'); 
    }    


           
}
