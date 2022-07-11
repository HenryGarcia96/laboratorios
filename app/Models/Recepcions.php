<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcions extends Model
{
    use HasFactory;
    public $fillable = ['folio', 'numOrden', 'numRegistro',
                        'paciente', 'empresa', 'servicio',
                        'tipPasiente', 'turno', 'doctor_id',
                        'numCama', 'peso', 'talla', 'fur',
                        'medicamento', 'diagnostico',
                        'observaciones', 'listPrecio'];
}