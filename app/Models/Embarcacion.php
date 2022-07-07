<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embarcacion extends Model
{
    protected $table = 'embarcacion';

    public $timestamps = false;
    
    protected $primaryKey= 'IdEmbarcacion';

    protected $fillable = [
        'IdEmbarcacion',
        'IdArmador',
        'Nombre',
        'Matricula',
        'PermisoPesca',
        'FechaVigenciaPermisoPesca',
        'Estado',
        'FechaRegistro',
        'Pais',
       
    ];
}
