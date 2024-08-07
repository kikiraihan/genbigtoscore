<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable=[
        'tanggal',
        'tahun',
        'semester',
    ];

    // protected $casts = [
    //     'tanggal' => 'datetime:Y-m-d',
    // ];




    // STATIC METHOD
    public static function idTerakhir()
    {
        return (new static)::orderBy('tahun','desc')->orderBy('semester','desc')->first()->id;
        // return (new static)::latest()->orderBy('id', 'desc')->first()->id;
    }
    public static function yangTerakhir()
    {
        return (new static)::orderBy('tahun','desc')->orderBy('semester','desc')->first();
        // return (new static)::latest()->orderBy('id', 'desc')->first();
    }


    public function getReleaseAttribute()
    {
        return $this->tanggal;
    }

    // MANY TO MANY
    public function anggotas()
    {
        return $this->belongsToMany
        (
            anggota::class, 
            'beasiswa_anggotas',
            'id_beasiswa',
            'id_anggota'
        )->withPivot('tgl_uang_kas');
    }

    public function isTheLastRecord()
    {
        // $orders = Order::where('id','>=', $order_id)->get();

        // $order = $orders->first();

        // if($orders->count() > 1) {
        // //...
        // // NOT the last record :(
        // //...
        // } else { 
        // //...
        // // Last record :)
        // //...
        // }
    }

    public function segmentbulanan()
    {
        return $this->hasMany(Segmentbulanan::class,'id_beasiswa','id');
    }

}
