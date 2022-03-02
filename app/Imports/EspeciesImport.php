<?php

namespace App\Imports;

use App\Models\especie;
use Maatwebsite\Excel\Concerns\ToModel;

class EspeciesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new especie([
            'nombre'     => $row[0],
            'nombre_cientifico'    => $row[1], 
            'id_tipo'  => 2, 
        ]);
    }
}
