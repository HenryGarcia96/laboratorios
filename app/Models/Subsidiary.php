<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Subsidiary extends Model
{
    
    protected $fillable = [
        'sucursal',
    ];
    
    use HasFactory;

// caja-sucursal-usuarios
    public function cajas(){
        return $this->belongsToMany(Caja::class, 'cajas_has_subsidiaries')->withPivot('laboratory_id', 'usuario_id');
    }

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'usuario_id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'laboratory_id');
    }


    // users has laboratories
    public function laboratorio(){
        return $this->belongsToMany(Laboratory::class, 'users_has_laboratories')->withPivot('usuario_id');
    }

    public function usuario(){
        return $this->belongsToMany(User::class, 'users_has_laboratories')->withPivot('laboratorio_id');
    }

    // subsidiaries has laboratories
    public function laboratory(){
        return $this->belongsToMany(Laboratory::class, 'subsidiaries_has_laboratories');
    }
    // Para traer a los usuarios asignados al laboratorio
    public function users(){
        return $this->belongsToMany(User::class, 'users_has_laboratories', 'sucursal_id', 'usuario_id');
    }
}
