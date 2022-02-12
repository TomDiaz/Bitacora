<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lanceArtePesca extends Model
{
    protected $table = 'lance_arte_de_pesca';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_arte',
        'id_lance',
        'tamanio',
        'tipo_malla',
        'luz_malla',
    ];
}
