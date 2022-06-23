<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = [
                        'apertura',
                        'entradas',
                        'ventas_efectivo',
                        'ventas_tarjeta',
                        'ventas_transferencia',
                        'salidas_efectivo',
                        'salidas_tarjeta',
                        'salidas_transferencia',
                        'total',
                        'estatus'
                    ];
// Relacion de cajas con sucursales y usuarios
    public function sucursales(){
        return $this->belongsToMany(Subsidiary::class, 'cajas_has_subsidiaries')->withPivot('laboratory_id', 'usuario_id');
    }

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'usuario_id');        
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'laboratory_id');
    }

    // Trae las cajas abiertas por el usuario
    public function user(){
        return $this->belongsToMany(User::class, 'cajas_has_subsidiaries', 'caja_id', 'laboratory_id', 'sucursal_id');
    }

}
