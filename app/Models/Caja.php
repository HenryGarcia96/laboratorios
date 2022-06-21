<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = ['sucursal_id','apertura','abierta', 'recepcion_id'];

    public function sucursales(){
        return $this->belongsToMany(Sucursal::class, 'cajas_has_subsidiaries')->withPivot('laboratorio_id', 'usuario_id');
    }

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'usuario_id');        
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'laboratorio_id');
    }


}
