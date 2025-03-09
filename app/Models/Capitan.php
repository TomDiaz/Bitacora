<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
class Capitan extends Authenticatable
{

    use Notifiable, CanResetPassword;

    protected $table = 'capitan';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'cuil',
        'nombres',
        'apellidos',
        'direccion',
        'celular',
        'email',
        'usuario',
        'clave',
        'estado',
        'fechaRegistro',
        'id_armador',
    ];

    public function getEmailForPasswordReset()
    {
        return $this->email;  
    }

    public function getAuthPassword()
    {
        return $this->clave;
    }

    public function getPasswordAttribute()
    {
        return $this->clave;
    }
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['clave'] = $value;
    }


    public function sendPasswordResetNotification($token)
    {
    
        Reset::where('email', $this -> email)->update([ 'type' => 'capitan']);

        $this->notify(new \App\Notifications\ResetPasswordCapitan($token, $this));
    }
}
