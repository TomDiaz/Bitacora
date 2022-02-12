<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coordenada extends Model
{
    protected $table = 'coordenadas';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_lance',
        'latitud',
        'longitud',
    ];
}
