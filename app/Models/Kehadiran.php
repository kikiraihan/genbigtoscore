<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_absen',
        'id_anggota',
        'bukti_foto',
        'catatan',
        'valid',
        'id_validator',
        'kondisi',
    ];

    public function getValueAttribute()
    {   
        // kondisixbobotabsen;
    }

    // SCOPE
    public function scopeHanyaYangHadir($query)
    {
        return $query->where('kondisi','hadir');
    }

    public function scopeHanyaYangTidakHadir($query)
    {
        return $query->where('kondisi','tidakhadir');
    }

    public function scopeHanyaYangIzin($query)
    {
        return $query->where('kondisi','izin');
    }

    // BELONGS TO
    public function anggota()
    {
        return $this->belongsTo(anggota::class,'id_anggota');
    }
    public function absensi()
    {
        return $this->belongsTo(Absensi::class,'id_absen');
    }

    // public function segmentbulanan()
    // {
    //     return $this->belongsTo(Segmentbulanan::class,'id_sb');
    // }

    public function validator()
    {
        return $this->belongsTo(anggota::class,'id_validator');
    }

}
