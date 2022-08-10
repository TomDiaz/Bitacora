<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capitan_armador extends Model
{
    protected $table = 'capitan_armador';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'id',
        'id_capitan',
        'id_armador',
        'estado',
        'token'
    ];
}
