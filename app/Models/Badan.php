<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badan extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama'
    ];

    public function absensi()
    {
        return $this->morphMany(
            Absensi::class, 
            'absensiable'
        );
    }

    public function kepengurusans()
    {
        return $this->hasManyThrough(Kepengurusan::class, Unit::class,'id_badan','id_unit');
    }

    public function units()
    {
        return $this->hasMany(Unit::class,'id_badan','id');
    }
}
