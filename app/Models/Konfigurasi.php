<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    use HasFactory;

    protected $table = 'konfigurasis';
    protected $fillable = ['name','value','keterangan'];

    //langsung
    public function scopeLangsung($query,$name)
    {
        return $query->where('name',$name)->first()->value;
    }


    //scope
    public function scopeName($query,$name)
    {
        return $query->where('name',$name);
    }

    public function scopeValue($query,$value)
    {
        return $query->where('value',$value);
    }

    public function scopeKeterangan($query,$keterangan)
    {
        return $query->where('keterangan',$keterangan);
    }


}
