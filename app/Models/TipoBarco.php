<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBarco extends Model
{
    protected $table = 'tipo_de_barco';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre',
    ];
}
