<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tambahan extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_sb',
        'id_anggota',
        'judul',
        'nilai',
    ];

    public function anggota()
    {
        $this->belongsTo(anggota::class,'id_anggota','id');
    }

    public function segmentbulanan()
    {
        return $this->belongsTo(Segmentbulanan::class,'id_sb');
    }
}
