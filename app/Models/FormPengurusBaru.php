<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengurusBaru extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_anggota',
        'id_unit',
    ];

    // relasi
    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'id_anggota');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
}
