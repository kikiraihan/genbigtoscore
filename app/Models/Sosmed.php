<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_anggota',
        'link',
        'icon',//facebook,ig,
        'username',
    ];

    
    public function anggota()
    {
        $this->belongsTo(anggota::class,'id_anggota','id');
    }

}
