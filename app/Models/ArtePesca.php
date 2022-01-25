<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtePesca extends Model
{
    protected $table = 'artepesca';

    public $timestamps = false;
    
    protected $primaryKey= 'IdArtePesca';

    protected $fillable = [
        'IdSector',
        'IdSubSector',
        'IdArtePesca',
        'Nombre',
        'Caracteristicas',
        'RegistraInicioPesca',
        'RegistraFinPesca',
        'RegistraCoordenadasInicioPesca',
        'RegistraCoordenadasFinPesca',
        'RegistraAperturaBitacora',
        'RegistraCierreBitacora',
        'RegistraCoordenadasAperturaBitacora',
        'RegistraCoordenadasCierreBitacora',
        'DeclaracionZonaPesca',
        'RegistraCantidadArte',
        'UnidadPeso',
        'CantidadMaximaLancesAbiertos',
        'CantidadMaximaLancesSinRegistroCaptura',
    ];
}
