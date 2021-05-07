<?php

namespace App\Exports;

use App\Models\Registry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\RegistryExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistryExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registry::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Company Name',
            'Address',
            'Postcode',
            'City',
            'District',
            'Region',
            'Email',
            'Created at',
            'Update at'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:J1')->getFont()->setSize(14)->setBold(true);
    }
}
