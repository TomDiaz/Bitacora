<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitan extends Model
{
    protected $table = 'capitan';

    public $timestamps = false;
    
    protected $primaryKey= 'IdCapitan';

    protected $fillable = [
        'IdCapitan ',
        'IdTipoIdentificacion',
        'Identificacion ',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Celular',
        'Email',
        'Usuario',
        'Clave',
        'Estado',
        'FechaRegistro',
        'IdArmador'
    ];
}
