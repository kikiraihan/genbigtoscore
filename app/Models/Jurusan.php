<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;


    protected $fillable=[
        'nama',
        'Strata',
        'kategori',
    ];

    public function anggota()
    {
        return $this->hasMany(anggota::class, 'id_jurusan','id');
    }
}
