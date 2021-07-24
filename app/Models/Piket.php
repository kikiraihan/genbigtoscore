<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_sb',
        'id_anggota',
        'bobot',
        'jumlah_tidak_hadir',  
        'jumlah_izin',
    ];

    protected $appends=[
        'total',
    ];

    public function getTotalAttribute()
    {
        return
        ($this->jumlah_tidak_hadir*$this->bobot)+
        ($this->jumlah_izin*-1);
    }

    public function anggota()
    {
        $this->belongsTo(anggota::class,'id_anggota','id');
    }

    public function segmentbulanan()
    {
        return $this->belongsTo(Segmentbulanan::class,'id_sb');
    }
}
