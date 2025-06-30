<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilAkhirExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($hasilAkhir)
    {
        $this->data = $hasilAkhir;
    }

    public function collection()
    {
        // Ubah ke collection sederhana untuk export
        return collect($this->data)->map(function ($row) {
            return [
                $row['ranking'],
                $row['pelamar'],
                $row['V'],
            ];
        });
    }

    public function headings(): array
    {
        return ['Ranking', 'Nama Pelamar', 'Nilai Akhir'];
    }
}
