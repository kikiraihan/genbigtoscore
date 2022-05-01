<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmentbulanan extends Model
{
    use HasFactory;

    protected $fillable=[
        'bulan',
        'id_beasiswa',
        'segtahun'
    ];

    // protected $casts = [
    //     'bulan' => 'datetime:Y-m-d',
    // ];

    // protected $appends=[
    //     // 'namaBulan',
    // ];

    // STATIC METHOD
    public static function idTerkini()//cuma jaga terpakai di penilaian manual
    {
        $return=
            (new static)::where('bulan',Carbon::now()->month)
            ->where('id_beasiswa',Beasiswa::idTerakhir())
            ->first();
        if(!$return)
        {
            // kalau tidak dapat yang terkini kembalikan yang terakhir
            $return=(new static)::where('id_beasiswa',Beasiswa::idTerakhir())
            ->orderBy('segtahun','desc')
            ->orderBy('bulan','desc')
            ->first();
        }
            
        return $return->id;
    }
    public static function yangTerkini()
    {
        return
            (new static)::where('bulan',Carbon::now()->month)
            ->where('id_beasiswa',Beasiswa::idTerakhir())
            ->first();
    }
    public static function idSegmentPadaBeasiswaTerkiniBulan($bulan)
    {
        // Carbon::now()->month
        return
            (new static)::where('bulan',$bulan)
            ->where('id_beasiswa',Beasiswa::idTerakhir())
            ->first()->id;
    }
    public static function idSegmentPadaBeasiswaIdDanBulan($idBea,$bulan)
    {
        // Carbon::now()->month
        return
            (new static)::where('bulan',$bulan)
            ->where('id_beasiswa',$idBea)
            ->first()->id;
    }

    public static function segmentAwalBeasiswa(Beasiswa $b)
    {
        return (new static)::where('id_beasiswa',$b->id)
            ->orderBy('segtahun','asc')
            ->orderBy('bulan','asc')
            ->first();
    }
    public static function segmentAkhirBeasiswa(Beasiswa $b)
    {
        return (new static)::where('id_beasiswa',$b->id)
            ->orderBy('segtahun','desc')
            ->orderBy('bulan','desc')
            ->first();
    }
    public static function tanggalPertamaBeasiswaIni(Beasiswa $b)
    {
        $seg=(new static)::segmentAwalBeasiswa($b);
        $seg->beasiswa;
        return Carbon::createFromDate($seg->segtahun,$seg->bulan,1);//$seg->beasiswa->tahun
    }
    public static function tanggalTerakhirBeasiswaIni(Beasiswa $b)
    {
        $seg=(new static)::segmentAkhirBeasiswa($b);
        $seg->beasiswa;
        return Carbon::createFromDate($seg->segtahun,$seg->bulan,1)->endOfMonth();//;
    }

    
    
    
    
    
    // SCOPE

    // scope
    public function scopeHanyaSemesterIni($query,$idBeasiswaTerakhir)
    {
        return $query->where('id_beasiswa',$idBeasiswaTerakhir);
    }

    public function scopeHanyaSekitarSemesterIni($query,$idBeasiswaTerakhir)
    {
        return $query
        ->where('id_beasiswa',$idBeasiswaTerakhir)
        ->orWhere('id_beasiswa',$idBeasiswaTerakhir+1)
        ->orWhere('id_beasiswa',$idBeasiswaTerakhir-1)
        ;
    }






    // attribute getter

    public function getTahunAttribute()
    {
        return $this->beasiswa->tahun;
    }
    public function getNamaBulanAttribute()
    {
        return $this->DateCarbonKhususBulan->monthName;
    }
    public function getDateCarbonAttribute()
    {
        return Carbon::createFromDate(
            $this->tahun, 
            $this->bulan,
            1)->locale('id');
    }
    public function getDateCarbonKhususBulanAttribute()
    {
        return Carbon::createFromDate(
            2000, 
            $this->bulan,
            1)->locale('id');
    }








    
    // RELATION

    public function nilaiEbsPerAnggota()
    {
        return $this->belongsToMany
        (
            anggota::class, 
            'nilaiebs',
            'id_sb',
            'id_anggota'
        )
        ->withPivot(
            'id',
            'nilai',
            )
        ;
    }

    public function PiketAnggotas()
    {
        return $this->belongsToMany
        (
            anggota::class, 
            'pikets',
            'id_sb',
            'id_anggota'
        )
        ->withPivot(
            'id',
            'bobot',
            'jumlah_tidak_hadir',  
            'jumlah_izin',
            // 'total'
            )
        ;
    }

    public function TambahanNilaiAnggotas()
    {
        return $this->belongsToMany
        (
            anggota::class, 
            'tambahans',
            'id_sb',
            'id_anggota'
        )
        ->withPivot(
            'id',
            'judul',
            'nilai',
            )
        ;
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class,'id_beasiswa');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class,'id_sb','id');
    }

    public function timkhus()
    {
        return $this->hasMany(Timkhu::class,'id_sb','id');
    }

    public function anggotaTimkhus()
    {
        return $this->hasMany(anggota_timkhu::class,'id_sb','id');
    }

    public function tambahans()
    {
        return $this->hasMany(Tambahan::class,'id_sb','id');
    }

    public function pikets()
    {
        return $this->hasMany(Piket::class,'id_sb','id');
    }
}
