<?php

namespace App\Exports;

use App\Models\Anggota;
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
        with(['kepengurusan.unit.badan','universitas'])
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

        return [
            $ang->nama,
            $ang->universitas->nama,
            round($nilai,2),
            $ang->menerima_beasiswa?'Penerima':'Tidak menerima',
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
            'Status Kelulusan',
        ];
    }



    // public function collection()
    // {
    //     return 
    // }
}
