<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timkhu extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_kegiatan',
        'id_kepala',
        'id_sb',
        'nama',
        'bobot',
        'jenis',
    ];



    // scope
    public function scopeHanyaSemesterIni($query,$idBeasiswaTerakhir)
    {
        return $query->whereHas('segmentbulanan',function($q) use ($idBeasiswaTerakhir) {
            $q->where('id_beasiswa',$idBeasiswaTerakhir);
        });
    }

    public function scopeHanyaSekitarSemesterIni($query,$idBeasiswaTerakhir)
    {
        return $query->whereHas('segmentbulanan',function($q) use ($idBeasiswaTerakhir) {
            $q->where('id_beasiswa',$idBeasiswaTerakhir)
            ->orWhere('id_beasiswa',$idBeasiswaTerakhir+1)
            ->orWhere('id_beasiswa',$idBeasiswaTerakhir-1)
            ;
        });
    }


    // MANY TO MANY
    public function anggotas()
    {
        return $this->belongsToMany
        (
            anggota::class, 
            'anggota_timkhus',
            'id_timkhu',
            'id_anggota'
        )
        // ->as('detail')
        ->withPivot([
            'id',
            'peran',
            'penilai',
            'nilai',
        ]);
    }

    // HAS MANY
    public function anggotatimkhusmodel()
    {
        return $this->hasMany(
            anggota_timkhu::class,
            'id_timkhu',
            'id'
        );
    }

    // morph many
    public function absensi()
    {
        return $this->morphMany(
            Absensi::class, 
            'absensiable'
        );
    }

    // belongsto
    public function kepala()
    {
        return $this->belongsTo(anggota::class,'id_kepala');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class,'id_kegiatan');
    }
    public function segmentbulanan()
    {
        return $this->belongsTo(Segmentbulanan::class,'id_sb');
    }
    
    
}
