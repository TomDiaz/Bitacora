<?php

namespace App\Exports;

use App\Models\bitacora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BitacoraExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;
    protected $encabezado;

    public function headings(): array
    {
        return  $this->encabezado;
    }


    public function __construct($data, $encabezado)
    {
        $this->data = $data;
        $this->encabezado = $encabezado;
    }

    public function collection()
    {
        return  $this->data;
    }
}
