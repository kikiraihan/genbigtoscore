<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilaieb extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_sb',
        'id_anggota',
        'nilai',
    ];


    public function getTotalNilaiAttribute()
    {
        $return=0;
        if($this->nilai!=0)
        {
            $param=explode('/',$this->nilai);
            $return= ( (30*$param[0]) / $param[1] );
        }
        return $return;
    }

    // relation
    public function anggota()
    {
        return $this->belongsTo(anggota::class,'id_anggota');
    }
    public function segmentbulanan()
    {
        return $this->belongsTo(Segmentbulanan::class,'id_sb');
    }
}
