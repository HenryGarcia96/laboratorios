<?php

namespace App\Models;

use GrahamCampbell\ResultType\Success;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Cajas-laboratorios-sucursales
    public function cajas(){
        return $this->belongsToMany(Caja::class, 'cajas_has_subsidiaries')->withPivot('sucursal_id', 'laboratorio_id');
    }

    public function sucursales(){
        return $this->belongsToMany(Subsidiary::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'laboratorio_id');
    }

    public function laboratorios(){
        return $this->belongsToMany(Laboratory::class, 'cajas_has_subsidiaries')->withPivot('caja_id', 'sucursal_id');
    }

    // Users has laboratories
    public function laboratorio(){
        return $this->belongsToMany(Laboratory::class, 'users_has_laboratories', 'sucursal_id', 'laboratorio_id', 'usuario_id')->withPivot('sucursal_id');
    }

    public function sucursal(){
        return $this->belongsToMany(Subsidiary::class, 'users_has_laboratories', 'laboratorio_id', 'sucursal_id',  'usuario_id')->withPivot('laboratorio_id');
    }

    // Para que me traiga las relaciones de usuarios registrados a laboratorios
    public function labs(){
        return $this->belongsToMany(Laboratory::class, 'users_has_laboratories', 'usuario_id', 'laboratorio_id' );
    }
    // Para que me traiga las relaciones de usuarios asignados a las sucursales
    public function sucs(){
        return $this->belongsToMany(Subsidiary::class, 'users_has_laboratories', 'usuario_id', 'sucursal_id');
    }
    // Trae las cajas abiertas por el usuario en Vista Cajas
    public function caja(){
        return $this->belongsToMany(Caja::class, 'cajas_has_subsidiaries', 'usuario_id');
    }

    // Para que me traiga las  relaciones de caja con usuario
}
