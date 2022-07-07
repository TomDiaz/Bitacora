<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitacora extends Model
{
    protected $table = 'bitacora';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_capitan',
        'id_embarcacion',
        'id_puerto_zarpe',
        'id_puerto_arribo',
        'id_zona_de_pesca',
        'nombre',
        'viaje_anual',
        'tripulantes',
        'fecha_inicial',
        'fecha_final',
        'combustible',
        'millas_recogidas',
        'produccion',
        'viento',
        'marea',
        'observador_a_bordo',
        'prospeccion',
        'subarea',
        'observaciones_generales',
        'observacion_parte_pesca'
    ];
}
