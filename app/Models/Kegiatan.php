<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama',
        'keterangan',
        'tanggal_pelaksanaan',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class,'id_kegiatan','id');
    }

    public function timkhu()
    {
        return $this->hasOne(Timkhu::class,'id_kegiatan','id');
    }


    // SCOPE
    // public function scopeHanyaSekitarSemesterIni($query,$idBeasiswaTerakhir)
    // {
    //     return $query->whereHas('segmentbulanan',function($q) use ($idBeasiswaTerakhir) {
    //         $q->where('id_beasiswa',$idBeasiswaTerakhir)
    //         ->orWhere('id_beasiswa',$idBeasiswaTerakhir+1)
    //         ->orWhere('id_beasiswa',$idBeasiswaTerakhir-1)
    //         ;
    //     });
    // }

    // public function inisiators()
    // {
    //     return $this->belongsToMany(
    //         Unit::class,
    //         "inisiators",
    //         'id_subbadan',
    //         'id_kegiatan'
    //     );
    // }
}
