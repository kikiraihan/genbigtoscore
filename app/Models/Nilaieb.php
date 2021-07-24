<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilaieb extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_sb',
        'id_anggota',
        'nilai',
    ];

    // public function 
}
