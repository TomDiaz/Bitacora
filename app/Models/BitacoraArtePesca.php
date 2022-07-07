<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraArtePesca extends Model
{
    protected $table = 'bitacora_arte_de_pesca';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_arte',
        'id_bitacora',
        'tamanio',
        'tipo_malla',
        'luz_malla',
        'nombre_dispositivo',
    ];
}
