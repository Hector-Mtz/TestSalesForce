<?php

namespace App\Exports;

use App\Models\Prospecto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProspectoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prospecto::all();
    }
}
