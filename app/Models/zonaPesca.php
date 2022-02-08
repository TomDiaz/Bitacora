<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zonaPesca extends Model
{
    protected $table = 'zonapesca';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre',
    ];
}
