<?php

namespace App\Exports;

use App\Models\anggota;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    public $statusAktif;

    public function __construct($statusAktif)
    {
        $this->statusAktif=$statusAktif;
    }

    public function headings(): array
    {
        return [
            // '#',
            'Username',
            'Nama',
            'Universitas',
            'Angkatan Kampus',
            'Beasiswa Semester Sebelumnya',
            'Unit',
            'Angkatan GenBI',
            'Role',
        ];
    }

    public function query()
    {
        $ang=anggota::
        with(['kepengurusan.unit.badan','universitas','user'])
        ->orderBy('id_universitas')
        ->orderBy('nama')
        ;

        if ($this->statusAktif) 
            $ang->hanyaYangAktif();
        else
            $ang->hanyaYangDemisioner();

        return $ang;
    }

    public function map($ang): array
    {
        return [
            $ang->user->username,
            $ang->nama,
            $ang->universitas->nama,
            $ang->tahunmasukkuliah,
            $ang->menerima_beasiswa?'Penerima':'Tidak menerima',
            $ang->kepengurusan?$ang->namaUnit:'',
            $ang->awalmasukgenbi,
            json_encode($ang->user->getRoleNames())
        ];
    }

    
}
