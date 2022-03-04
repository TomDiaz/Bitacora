<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lance extends Model
{
    protected $table = 'lances';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_bitacora',
        'id_zona_de_pesca',
        'nombre',
        'fecha_inicial',
        'fecha_final',
        'sin_captura',
        'temperatura',
        'otro',
        'mitigacion',
        'progreso'
    ];
}
