<?php

namespace App\Exports;

use App\Models\anggota;
use App\Models\Beasiswa;
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
        $this->id_beasiswa=Beasiswa::idTerakhir();
    }

    public function headings(): array
    {
        return [
            // '#',
            'Username',
            'Nama',
            'NIM',
            'Universitas',
            'Angkatan Kampus',
            'Beasiswa Semester Sebelumnya',
            'Total Beasiswa',
            'Rincian Beasiswa',
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
        $beasiswaall=[];
        foreach ($ang->beasiswas as $key => $value) 
            array_push($beasiswaall, $value->tahun."-".$value->semester);

        return [
            $ang->user->username,
            $ang->nama,
            $ang->nim,
            $ang->universitas->nama,
            $ang->tahunmasukkuliah,
            $ang->isMenerimaBeasiswa($this->id_beasiswa)?'Penerima':'Tidak menerima',
            count($beasiswaall),
            json_encode($beasiswaall),
            $ang->kepengurusan?$ang->namaUnit:'',
            $ang->awalmasukgenbi,
            json_encode($ang->user->getRoleNames())
        ];
    }

    
}
