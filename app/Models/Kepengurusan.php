<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepengurusan extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_anggota',
        'id_unit',
        // 'jabatan',
        // 'periode',
        'tanggal_demisioner',
    ];

    protected $casts = [
        'tanggal_demisioner' => 'datetime:Y-m-d',
    ];

    public function anggota()
    {
        return $this->belongsTo(anggota::class,'id_anggota');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'id_unit')->with('badan');
    }

}
