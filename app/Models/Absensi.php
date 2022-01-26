<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'date',
        'deadline_absen',
        'skope',
        'absensiable_type',
        'absensiable_id',
        'pengurangan',
        'id_sb',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'deadline_absen' => 'datetime:Y-m-d',
    ];


    public function absensiable()//berelasi dengan scope ->badan, unit, timkhusus, allgenbi (null)
    {
        return $this->morphTo();
    }

    // MANY TO MANY
    public function absenanggota()
    {
        return $this->belongsToMany
        (
            anggota::class,
            'kehadirans',
            'id_absen',
            'id_anggota'
        )
        // ->as('detail')
        ->withPivot([
            'id',
            'bukti_foto',
            'catatan',
            'valid',
            'id_validator',
            'kondisi'
        ])
        ;
    }
    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class,'id_absen','id');
    }
    public function segmentbulanan()
    {
        return $this->belongsTo(Segmentbulanan::class,'id_sb');
    }


    /* ----------------------------------------------------------------
    SCOPE
    ---------------------------------------------------------------- */

    public function scopeYangPunyaSegmentPadaBeasiswaIni($query,$idBeasiswa)
    {
        return $query->whereHas('segmentbulanan',function ($query) use($idBeasiswa){
            $query->where('id_beasiswa', $idBeasiswa);
        });
    }

    public function scopeYangPunyaUnitIni($query,$idUnit)
    {
        return $query->whereHas('absensiable',function ($query) use($idUnit){
            $query->where('id', $idUnit);
        });
    }

    
}
