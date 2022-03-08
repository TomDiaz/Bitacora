<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especieLance extends Model
{
    protected $table = 'especie_lance';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_lance',
        'id_especie',
        'id_tipo',
        'kilogramos',
        'cajones',
        'talla_tamanio',
        'unidades',
        'id_armador'
    ];
}
