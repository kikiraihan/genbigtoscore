<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota_timkhu extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_anggota',
        'id_timkhu',
        'peran',
        'penilai',
        'nilai',
    ];

    protected $appends=[
        'inivalue',
    ];

    public function getInivalueAttribute()
    {   return "jadi";
        // kondisixbobotabsen;
    }

    // public function segmentbulanan()
    // {
    //     return $this->belongsTo(Segmentbulanan::class,'id_sb');
    // }
    public function anggota()
    {
        return $this->belongsTo(anggota::class,'id_anggota');
    }
    public function timkhu()
    {
        return $this->belongsTo(Timkhu::class,'id_timkhu');
    }
}
