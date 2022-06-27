<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'descripcion',
        'observaciones',
    ];

    use HasFactory;

    // laboratorios que crearon areas de estudio
    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'areas_has_laboratories');
    }
}
