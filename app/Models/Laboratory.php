<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    public function cajas(){
        return $this->belongsToMany(Caja::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'usuario_id');
    }

    public function sucursales(){
        return $this->belongsToMany(Sucursal::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'usuario_id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'usuario_id');
    }
}
