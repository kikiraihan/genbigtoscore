<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'id_badan',
        'id_ketua',
        'singkat',
        'logo',
        'nama',
        'status',
    ];



    // MANY TO MANY
    public function anggotaAktif()
    {
        return $this->belongsToMany(
            anggota::class,
            'kepengurusans',
            'id_unit',
            'id_anggota'
            )
            ->wherePivotNull('tanggal_demisioner');
    }

    public function anggotaDemisioner()
    {
        return $this->belongsToMany(
            anggota::class,
            'kepengurusans',
            'id_unit',
            'id_anggota'
            )
            ->wherePivotNotNull('tanggal_demisioner');
    }


    // BELONGS TO
    public function ketua()
    {
        return $this->belongsTo(anggota::class,'id_ketua');
    }

    public function badan()
    {
        return $this->belongsTo(Badan::class,'id_badan');
    }

    // HAS MANY
    public function kepengurusan()
    {
        return $this->hasMany(Kepengurusan::class,'id_unit','id');
    }

    public function absensi()
    {
        return $this->morphMany(
            Absensi::class, 
            'absensiable'
        );
    }
}
