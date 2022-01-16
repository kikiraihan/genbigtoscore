<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_user',
        'nama',
        'nim',
        'id_jurusan',
        'id_universitas',
        'tahunmasukkuliah',
        'jenis_kelamin',
        'agama',
        'golongan_darah',
        'tgl_lahir',
        'domisili',
        'asal',
        'no_wa',
    ];

    protected $casts = [
        'tgl_lahir' => 'datetime:Y-m-d',
    ];

    // appends dibutuhkan hanya ketika kita ingin otomatis menambahkan ketika mengkonversi ke array
    protected $appends=[
        // 'menerima_beasiswa',
        // 'awalmasukgenbi',
    ];
    


    /* ----------------------------------------------------------------
    ACCESSOR DAN MUTATOR
    SETTER DAN GETTER
    ---------------------------------------------------------------- */

    

    // cara memperoleh nilai
    // anggota::find(2)->timkhus[0]->detail->nilai
    // => 2.0
    // >>> anggota::find(2)->timkhus[0]->bobot
    // => 20

    public function getAwalMasukGenbiAttribute()
    {
        $beasiswa1=$this->beasiswas()->oldest()->orderBy('id', 'asc')->first();
        if(!$beasiswa1) return "not found";
        return $beasiswa1->tahun."/".$beasiswa1->semester;
    }

    public function getMenerimaBeasiswaAttribute()
    {
        $saya=$this->beasiswas()->latest()->orderBy('id', 'desc')->first();
        if(!$saya)
            return false;

        $beasiswaTerakhir=Beasiswa::idTerakhir();
        
        return ($beasiswaTerakhir==$saya->id);
    }

    public function getNamaUnitSingkatAttribute(){
        return $this->unit->singkat; 
    }

    public function getNamaUnitAttribute(){
        return $this->unit->nama;    
    }

    public function getNamaBadanAttribute(){
        return $this->badan->nama;    
    }

    public function getMenerima4KaliAttribute()
    {
        if($this->beasiswas()->count()==4)
        return true;
        else
        return false;
    }


    // getter berparameter
    public function getNilaiPadaTimkhu($idTim)
    {
        $tim=$this->timkhus()->where('id',$idTim)->first();
        $param=explode('/',$tim->pivot->nilai);
        
        if($tim->pivot->peran=="pengurus-inti")
            return ( (($tim->bobot/2)*$param[0]) / $param[1] );//1/5 kali setengah bobot
        
        elseif($tim->pivot->peran=="anggota" or $tim->pivot->peran=="kepala" )
            return ( ($tim->bobot*$param[0]) /$param[1] );
    }



    /* ----------------------------------------------------------------
    RELATION
    ---------------------------------------------------------------- */

    // MANY TO MANY
    public function beasiswas()
    {
        return $this->belongsToMany
        (
            Beasiswa::class, 
            'beasiswa_anggotas',
            'id_anggota',
            'id_beasiswa'
        );
    }

    public function nilaiEbs()
    {
        return $this->belongsToMany
        (
            Segmentbulanan::class, 
            'nilaiebs',
            'id_anggota',
            'id_sb'
        )
        ->withPivot(
            'id',
            'nilai',
            )
        ;
    }

    public function piketSegments()
    {
        return $this->belongsToMany
        (
            Segmentbulanan::class, 
            'pikets',
            'id_anggota',
            'id_sb'
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

    public function kehadiranAbsensi()
    {
        return $this->belongsToMany
        (
            Absensi::class, 
            'kehadirans',
            'id_anggota',
            'id_absen'
        )
        ->withPivot(
            'id',
            'bukti_foto',
            'catatan',
            'valid',
            'id_validator',
            'kondisi',
            )
        ;
    }

    public function tidakHadirAbsensi()
    {
        return $this->belongsToMany
        (
            Absensi::class, 
            'kehadirans',
            'id_anggota',
            'id_absen'
        )
        ->withPivot(
            'id',
            'bukti_foto',
            'catatan',
            'valid',
            'id_validator',
            'kondisi',
            )
        ->wherePivot('kondisi','!=','hadir')
        ;
    }

    public function nilaiTambahanSegments()
    {
        return $this->belongsToMany
        (
            Segmentbulanan::class, 
            'tambahans',
            'id_anggota',
            'id_sb'
        )
        ->withPivot(
            'id',
            'judul',
            'nilai',
            )
        ;
    }

    public function timkhus()
    {
        return $this->belongsToMany
        (
            Timkhu::class, 
            'anggota_timkhus',
            'id_anggota',
            'id_timkhu',
        )
        // ->as('detail')
        ->withPivot(
            'id',
            'peran',
            'penilai',
            'nilai'
            )
        ;
    }

    // BELONGS TO
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function universitas()
    {
        return $this->belongsTo(Universitas::class,'id_universitas','id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    }
    
    // public function beasiswaPertama()
    // {
    //     return $this->belongsTo(Beasiswa::class,'id_beasiswa_pertama','id');
    // }

    // HAS ONE
    public function badan()
    {
        return $this->unit->badan();
    }
    public function unit()
    {
        return $this->kepengurusanWithUnit->unit();
    }
    public function kepengurusanWithUnit()
    {
        return $this->hasOne(Kepengurusan::class,'id_anggota','id')->with('unit');
    }
    public function kepengurusan()
    {
        return $this->hasOne(Kepengurusan::class,'id_anggota','id');
    }
    

    // HAS MANY
    public function anggotatimkhusmodel()
    {
        return $this->hasMany(
            anggota_timkhu::class,
            'id_anggota',
            'id'
        );
    }

    public function mengepalaitimkhus()
    {
        return $this->hasMany(
            Timkhu::class,
            'id_kepala',
            'id'
        );
    }

    public function piket()
    {
        return $this->hasMany(
            Piket::class,
            'id_anggota',
            'id'
        );
    }

    public function tambahan()
    {
        return $this->hasMany(
            Tambahan::class,
            'id_anggota',
            'id'
        );
    }

    public function kehadiran()
    {
        return $this->hasMany(
            kehadiran::class,
            'id_anggota',
            'id'
        );
    }

    public function sosmed()
    {
        return $this->hasMany(
            Sosmed::class,
            'id_anggota',
            'id'
        );
    }

    public function ipksebelumnya()
    {
        return $this->hasMany(
            Ipksebelumnya::class,
            'id_anggota',
            'id'
        );
    }

    public function ipkterakhir()
    {
        return $this->
        hasOne(Ipksebelumnya::class,'id_anggota','id')
        ->latestOfMany();
    }

    public function nilaiebsmodel()
    {
        return $this->hasMany(
            Nilaieb::class,
            'id_anggota',
            'id'
        );
    }

    





    // public function unit()
    // {
    //     return $this->belongsToMany(
    //         Unit::class,
    //         'anggotaunits',
    //         "id_pegawai",
    //         "id_unit"
    //     );
    // }



    /* ----------------------------------------------------------------
    SCOPE
    ---------------------------------------------------------------- */

    public function scopeHanyaYangAktif($query)
    {
        return $query->whereHas('kepengurusan',function ($query){
            $query->where('tanggal_demisioner', null);
        });
    }

    public function scopeHanyaYangDemisioner($query)
    {
        return $query->whereHas('kepengurusan',function ($query){
            $query->where('tanggal_demisioner','<>', null);
        });
    }

    public function scopeHanyaPengurusIni($query,$id_badan)
    {
        return $query->whereHas('kepengurusan',function ($query) use ($id_badan){
                $query->whereHas('unit', function ($query) use ($id_badan){
                    $query->whereHas('badan', function ($query) use ($id_badan){
                        $query->where('id', $id_badan);
                    });
                });
        });
    }

    public function scopeHanyaYangPunyaUnitIni($query,$id_unit)
    {
        return $query->whereHas('kepengurusan',function ($query) use ($id_unit){
            $query->where('id_unit', $id_unit); 
        });
    }

    public function scopeHanyaYangPunyaRoleIni($query,$arrayRole)//["Kepala Unit","Kekom","Korwil"]
    {
        $query->whereHas('user',function ($qu) use ($arrayRole){
            return $qu->whereHas('roles', function ($q) use ($arrayRole){
                return $q->whereIn('name', $arrayRole);
            });
        });
    }

    public function scopeBernama($query,$search)
    {
        return $query->where('nama', 'like', '%'.$search.'%');
    }

    public function scopeHanyaPenerimaBeasiswaIni($query,$id_beasiswa)
    {
        
        return $query->whereHas('beasiswas',function($q) use($id_beasiswa){
            $q->where('id',$id_beasiswa);
        });
    }



    /* ----------------------------------------------------------------
    FUNGSI PENGAMBIL TABEL2 PENILAIAN
    ---------------------------------------------------------------- */

    public function getAbsenPadaBeasiswa($idBeasiswa)
    {
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan()->get('id');
        foreach ($segments as $seg)
            $ids[]=$seg->id;

        return $this->kehadiranAbsensi()
        ->with('segmentbulanan')
        ->whereIn('id_sb', $ids)
        ->get()
        ;
    }

    public function getPiketPadaBeasiswa($idBeasiswa)
    {
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan()->get('id');
        foreach ($segments as $seg)
            $ids[]=$seg->id;

        return $this->piket()
        ->with('segmentbulanan')
        ->whereIn('id_sb', $ids)
        ->get()
        ;
    }

    public function getNilaiTimkhuPadaBeasiswa($idBeasiswa)
    {
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan()->get('id');
        foreach ($segments as $seg)
            $ids[]=$seg->id;

        return 
        $this->anggotatimkhusmodel()->with('timkhu.segmentbulanan')
        ->whereHas('timkhu',function ($query) use ($ids){
            return $query->whereIn('id_sb', $ids);
        }) 
        ->get()
        ;
    }

    public function getTambahanPadaBeasiswa($idBeasiswa)
    {
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan()->get('id');
        foreach ($segments as $seg)
            $ids[]=$seg->id;

        return 
        $this->nilaiTambahanSegments()
        ->wherePivotIn('id_sb', $ids)
        ->get()
        ;
    }

    public function getEbPadaBeasiswa($idBeasiswa)
    {
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan()->get('id');
        foreach ($segments as $seg)
            $ids[]=$seg->id;

        return 
        $this->nilaiebsmodel()
        ->with('segmentbulanan')
        ->whereIn('id_sb',$ids)
        ->get()
        ;
    }



    /* ----------------------------------------------------------------
    FUNGSI PENGAMBIL NILAI ATP DAN EB
    ---------------------------------------------------------------- */


    public function getAtpSayaPadaSegment($idSegment)
    {
        $absen=0;
        foreach($this->tidakHadirAbsensi()->where('id_sb',$idSegment)->get() as $abs)
        {
            if($abs->pivot->kondisi=='tidakhadir')
                $absen+=(-1*abs($abs->pengurangan));
            elseif($abs->pivot->kondisi=='izin')
                $absen+=-1;
        };

        $piket=0;
        $pik=$this->piketSegments()->wherePivot('id_sb',$idSegment)->first();
        if($pik)
            $piket=($pik->pivot->jumlah_tidak_hadir*$pik->pivot->bobot)+($pik->pivot->jumlah_izin*-1);
        

        $panitia=0;
        foreach($this->timkhus()->where('id_sb',$idSegment)->get() as $tim)
        {
            if($tim->pivot->nilai==0)
                $panitia+=0;
            else
            {
                $param=explode('/',$tim->pivot->nilai);
                if($tim->pivot->peran=="pengurus-inti")
                {
                    $panitia+=((($tim->bobot/2)*$param[0])/$param[1]);//1/5 kali setengah bobot
                }
                elseif($tim->pivot->peran=="anggota" or $tim->pivot->peran=="kepala" )
                {
                    $panitia+=(($tim->bobot*$param[0])/$param[1]);
                }
            }
        };

        
        $tambahan=0;
        foreach (
            $this->nilaiTambahanSegments()->wherePivot('id_sb',$idSegment)->get() 
            as $tam) 
            {
            $tambahan+=$tam->pivot->nilai;
        }

        // return ([$absen+$piket+$panitia+$tambahan,'-',$absen,$piket,$panitia,$tambahan]);
        return $absen+$piket+$panitia+$tambahan;
    }

    public function getEbSayaPadaSegment($idSegment)
    {
        $evaluasi=0;
        $e=$this->nilaiEbs()->wherePivot('id_sb',$idSegment)->first();
        if($e and $e->pivot->nilai!=0)
        {
            $param=explode('/',$e->pivot->nilai);
            $evaluasi+=((30*$param[0])/$param[1]);
        }
        return $evaluasi;
    }


    public function getAtpBeasiswaFull($idBeasiswa)
    {
        $j_atp=0;
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan;
        $n=$segments->count();
        if($n==0) return 0;

        foreach ($segments as $seg) 
        {
            $j_atp+=$this->getAtpSayaPadaSegment($seg->id);
        }
        // return $j_atp;
        return ( ( ($j_atp+($n*30))/($n*30) )*100 );
    }

    public function getEbBeasiswaFull($idBeasiswa)
    {
        $j_eb=0;
        $segments=Beasiswa::find($idBeasiswa)->segmentbulanan;
        $n=$segments->count();
        if($n==0) return 0;

        foreach ($segments as $seg) 
        {
            $j_eb+=$this->getEbSayaPadaSegment($seg->id);
        }
        return ( ($j_eb/($n*30))*100 );
    }

    public function getNilaiAkhir($idBeasiswa)
    {
        //70% atp // 30% eb
        return $this->getAtpBeasiswaFull($idBeasiswa)*0.7
        +$this->getEbBeasiswaFull($idBeasiswa)*0.3;
    }

    public function statusLulus($idBeasiswa)
    {
        if($this->getNilaiAkhir($idBeasiswa) >=70)
            return true;
        else
            return false;
    }



    /* ----------------------------------------------------------------
    FUNGSI BUATAN LAINNYA
    ---------------------------------------------------------------- */


    public function isKorwil()
    {
        return $this->user->hasRole('Ketua') and $this->badan->nama=="Wilayah";
    }
}
