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
    protected $cabecera;

    public function headings(): array
    {
        return $this->cabecera;
    }

    public function __construct($data, $cabecera)
    {
        $this->data = $data;
        $this->cabecera = $cabecera;
    }

    public function collection()
    {
        return  $this->data;
    }
}
