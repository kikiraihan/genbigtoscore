<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PiketTemplate implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            // '#',
            'Badan',
            'Nama',
            'tidak_hadir',
            'izin',
        ];
    }

    public function query()
    {
        $ang=anggota::
        with(['kepengurusan.unit.badan','universitas','user'])
        ->hanyaYangAktif()
        ->orderBy('id_universitas')
        ->orderBy('nama')
        ;

        return $ang;
    }

    public function map($ang): array
    {
        return [
            $ang->namaBadan,
            $ang->nama,
            '0',
            '0',
        ];
    }

}
