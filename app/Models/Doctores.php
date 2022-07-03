<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctores extends Model
{
    use HasFactory;
    public $fillable = ['clave', 'nombre', 'ap_paterno',
                        'ap_materno', 'telefono', 'celular',
                        'email', 'usuario', 'password'];
}
