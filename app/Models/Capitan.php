<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitan extends Model
{
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
        'id_armador'
    ];
}
