<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitanEmbarcacion extends Model
{
    protected $table = 'capitanembarcacion';

    public $timestamps = false;
    
    protected $primaryKey= 'IdCapitan';

    protected $fillable = [
        'IdCapitan',
        'IdEmbarcacion',
        'FechaIngreso',
    ];
}
