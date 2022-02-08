<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtePesca extends Model
{
    protected $table = 'artepesca';

    public $timestamps = false;
    
    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre',
     
    ];
}
