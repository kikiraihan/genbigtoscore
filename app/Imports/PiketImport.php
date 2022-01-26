<?php

namespace App\Imports;

use App\Models\anggota;
use App\Models\Piket;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PiketImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;

    public $id_sb;
    public $bobot;

    public function __construct($id_sb,$bobot)
    {
        $this->id_sb=$id_sb;
        $this->bobot=$bobot;
    }
    
    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $a=anggota::where('nama',$value)->first();
                    if($a)
                    {
                        if ($a->piket()->where('id_sb',$this->id_sb)->exists()) {
                            $fail($attribute.' sudah ada duplikasi.');
                        }
                    }
                    else
                    {
                        $fail($attribute.' tidak ditemukan.');
                    }
                    
                },
            ],
            'tidak_hadir' => [
                'required',
                'numeric',
                'min:0',
            ],
            'izin' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }

    public function model(array $row)
    {
        $a=anggota::where('nama',trim($row['nama']))->first();
        return new Piket([
            'id_sb'=>$this->id_sb,
            'id_anggota'=>$a->id,
            'bobot'=>$this->bobot,
            'jumlah_tidak_hadir'=>trim($row['tidak_hadir']),  
            'jumlah_izin'=>trim($row['izin']),
        ]);
    }
}
