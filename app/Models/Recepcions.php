<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcions extends Model
{
    use HasFactory;

    public $fillable = ['folio', 'numOrden', 'numRegistro',
    'id_paciente', 'id_empresa', 'servicio',
    'tipPasiente', 'turno', 'id_doctor',
    'numCama', 'peso', 'talla', 'fur',
    'medicamento', 'diagnostico',
    'observaciones', 'listPrecio'];


    public function empresas(){
        return $this->belongsTo(Empresas::class, 'id_empresa');
    }
    public function pacientes(){
        return $this->belongsTo(Pacientes::class, 'id_paciente');
    }
    public function doctores(){
        return $this->belongsTo(Doctores::class, 'id_doctor');
    }
}

