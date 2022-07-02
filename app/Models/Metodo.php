<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
    protected $fillable = [
        'descripcion',
        'observaciones',
    ];
    
    use HasFactory;

    public function laboratorios(){
        return $this->belongsToMany(Metodo::class, 'metodos_has_laboratories');
    }
}
