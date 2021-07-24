<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipksebelumnya extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_anggota',
        'ipk',
    ];
    

    public function anggota()
    {
        $this->belongsTo(anggota::class,'id_anggota','id');
    }
}
