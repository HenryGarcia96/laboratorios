<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Laboratory extends Model
{
    protected $fillable = [
        'nombre',
        'razon_social',
        'ciudad',
        'estado',
        'pais',
        'cp',
        'email',
        'telefono',
        // 'rfc',
    ];

    use HasFactory;
    // cajas- sucursales- usuarios
    public function cajas(){
        return $this->belongsToMany(Caja::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'usuario_id');
    }

    public function sucursales(){
        return $this->belongsToMany(Subsidiary::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'usuario_id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'sucursal_id');
    }

    // users_has_laboratories
    public function user(){
        return $this->belongsToMany(User::class, 'users_has_laboratories')->withPivot('sucursal_id');
    }

    public function sucursal(){
        return $this->belongsToMany(Subsidiary::class, 'users_has_laboratories')->withPivot('user_id');
    }

    // subsidiaries has laboratories
    public function subsidiary(){
        return $this->belongsToMany(Subsidiary::class, 'subsidiaries_has_laboratories', 'laboratorio_id', 'sucursal_id');
    }

    // Recupera usuarios adjuntos a la clinica
    public function users(){
        return $this->belongsToMany(User::class, 'users_has_laboratories',  'laboratorio_id','usuario_id',);
    }

    // Areas (de los estudios)
    public function areas(){
        return $this->belongsToMany(Area::class, 'areas_has_laboratories');
    }

    // Muestras de los estudios
    public function muestras(){
        return $this->belongsToMany(Muestra::class, 'muestras_has_laboratories');
    }

    //Recipientes de los estudios
    public function recipientes(){
        return $this->belongsToMany(Recipiente::class, 'recipientes_has_laboratories');
    } 
}
