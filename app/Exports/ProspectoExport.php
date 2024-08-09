<?php

namespace App\Exports;

use App\Models\Prospecto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectoExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            "Nombre",
            "Apellidos",
            "Email",
            "Teléfono",
            'Mensaje',
            'Propietario',
            //'Vendedor anterior',
            'Asignacion',
            'Sede',
            'Tipo de prospecto',
            'Status actual',
            'Producto de interés',
            'Campaña / Canal',
            'Origen',
            'Monto de enganche',
            'Forma de contacto',
            'Horario de contacto',
            'Busqueda de terreno para',
            'Inversion al mes',
            'Tiempo de inversión',
            'Idioma',
            'Fecha de creación'
        ];
    }
}
