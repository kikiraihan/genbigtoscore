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
        'totalNilai',
    ];

    public function getTotalNilaiAttribute()
    {   
        if($this->nilai==0)
        {
            return $this->nilai;
        }
        
        $tim=$this->timkhu;
        $param=explode('/',$this->nilai);
        
        if($this->peran=="pengurus-inti")
            return ( (($tim->bobot/2)*$param[0]) / $param[1] );//1/5 kali setengah bobot
        
        elseif($this->peran=="anggota" or $this->peran=="kepala" )
            return ( ($tim->bobot*$param[0]) /$param[1] );
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
