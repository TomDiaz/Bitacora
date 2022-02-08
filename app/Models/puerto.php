<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puerto extends Model
{
    protected $table = 'puerto';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre',
    ];
}
