<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama',
        'singkatan',
        'logo',
    ];

    public function anggota()
    {
        return $this->hasMany(anggota::class, 'id_universitas','id');
    }
}
