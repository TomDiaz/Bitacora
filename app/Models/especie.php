<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especie extends Model
{
    protected $table = 'especies';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id_tipo',
        'nombre',
        'nombre_cientifico',
        
    ];
}
