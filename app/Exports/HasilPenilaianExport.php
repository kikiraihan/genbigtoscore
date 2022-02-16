<?php

namespace App\Exports;

use App\Models\anggota;
use App\Models\Beasiswa;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilPenilaianExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($id_beasiswa)
    {
        $this->$id_beasiswa=$id_beasiswa;
    }

    public function query()
    {
        return anggota::
        with(['kepengurusan.unit.badan','universitas','beasiswas'])
        ->hanyaYangAktif()
        ->orderBy('id_universitas')
        ->orderBy('nama')
        ;
    }

    public function map($ang): array
    {
        // $nilai=$ang->getNilaiAkhir($this->id_beasiswa);
        $nilai=$ang->getNilaiAkhir(Beasiswa::idTerakhir());

        if ($nilai<70)
            $status="Tidak Lulus";
        elseif ($ang->Menerima4Kali)
            $status="Tidak Lulus, Karena menerima 4 kali";
        else
            $status="Lulus";

        $beasiswaall=[];
        foreach ($ang->beasiswas as $key => $value) 
            array_push($beasiswaall, $value->tahun."-".$value->semester);

        return [
            $ang->nama,
            $ang->universitas->nama,
            round($nilai,2),
            $ang->menerima_beasiswa?'Penerima':'Tidak menerima',
            count($beasiswaall),
            json_encode($beasiswaall),
            $status,
        ];
    }

    public function headings(): array
    {
        return [
            // '#',
            'Nama',
            'Universitas',
            'Nilai',
            'Beasiswa Semester Sebelumnya',
            'Total Beasiswa',
            'Rincian Beasiswa',
            'Status Kelulusan',
        ];
    }



    // public function collection()
    // {
    //     return 
    // }
}
