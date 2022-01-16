<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'id_badan',
        'singkat',
        'logo',
        'nama',
        'status',
    ];


    // STATIC METHOD
    public static function semuaId()
    {
        $ar=(new static)::select(['id'])->get()->toArray();
        $return=[];
        foreach ($ar as $key => $value) {
            $return[]=$value['id'];
        }

        return $return;
    }


    //SCOPE
    public function scopeHanyaYangAktif($query)
    {
        return 
            $query->where('status', 'aktif');
    }


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
    public function RelasiKetua()
    {
        return $this->anggotaAktif()
            ->HanyaYangPunyaRoleIni(["Kepala Unit","Kekom","Korwil"]);
    }
    //dpe getter
    public function getKetuaAttribute()
    {
        return $this->RelasiKetua->first();
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
