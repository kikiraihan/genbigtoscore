<?php

namespace App\Traits;

use App\Models\anggota;
use App\Models\anggota_timkhu;
use App\Models\Beasiswa;
use App\Models\Kehadiran;
use App\Models\Nilaieb;
use App\Models\Piket;
use App\Models\Tambahan;

trait HitungNilai 
{
    public function allNilai(Beasiswa $beasiswa,$anggotas)
    {
        $return=[];
        foreach ($anggotas as $anggota) {
            $return[$anggota->id]=$this->getNilaiAkhir($beasiswa,$anggota->id);
        }
        return $return;
    }

    public function getNilaiAkhir(Beasiswa $beasiswa, $idAnggota)//per satu anggota, per beasiswa/semester
    {
        //70% atp // 30% eb
        return $this->getAtpBeasiswaFull($beasiswa,$idAnggota)*0.7
        +$this->getEbBeasiswaFull($beasiswa,$idAnggota)*0.3;
    }

    public function getEbBeasiswaFull(Beasiswa $beasiswa, $idAnggota)
    {
        $j_eb=0;
        $segments=$beasiswa->segmentbulanan;
        $n=$segments->count();
        if($n==0) return 0;

        foreach ($segments as $s) $listId[]=$s->id;

        foreach (Nilaieb::whereIn('id_sb',$listId)->where('id_anggota',$idAnggota)->get() as $ni) 
        {
            if($ni and $ni->nilai!=0)
            {
                $param=explode('/',$ni->nilai);
                $j_eb+=((30*$param[0])/$param[1]);
            }
        };

        return ( ($j_eb/($n*30))*100 );
    }


    public function getAtpBeasiswaFull(Beasiswa $beasiswa, $idAnggota)
    {
        $j_atp=0;
        $segments=$beasiswa->segmentbulanan;
        $n=$segments->count();
        if($n==0) return 0;

        //list segment
        foreach ($segments as $s) $listId[]=$s->id;

        //hitung absen
        $absen=0;
        foreach (
            Kehadiran::with('absensi')->whereHas('absensi',function($q) use($listId){
                $q->whereIn('id_sb',$listId);
            })
            ->where('id_anggota',$idAnggota)
            ->where('kondisi','!=','hadir')->get() as $abs
        ) 
        {
            if($abs->kondisi=='tidakhadir')
                $absen+=(-1*abs($abs->absensi->pengurangan));
            elseif($abs->kondisi=='izin')
                $absen+=-1;
        };

        //hitung piket
        $piket=0;
        foreach (Piket::whereIn('id_sb',$listId)->where('id_anggota',$idAnggota)->get() as $p) 
        {
            if($p) $piket+=$p->total;
        }

        //hitung panitia
        $panitia=0;
        foreach(anggota_timkhu::with('timkhu')
            ->whereHas('timkhu',function($q) use($listId){
                $q->whereIn('id_sb',$listId);
            })
            ->where('id_anggota',$idAnggota)->get() as $angtim)
        {
            if($angtim->nilai==0)
                $panitia+=0;
            else
            {
                $param=explode('/',$angtim->nilai);
                if($angtim->peran=="pengurus-inti")
                {
                    $panitia+=((($angtim->timkhu->bobot/2)*$param[0])/$param[1]);//1/5 kali setengah bobot
                }
                elseif($angtim->peran=="anggota" or $angtim->peran=="kepala" )
                {
                    $panitia+=(($angtim->timkhu->bobot*$param[0])/$param[1]);
                }
            }
        };

        //hitung tambahan
        $tambahan=0;
        foreach (Tambahan::whereIn('id_sb',$listId)->where('id_anggota',$idAnggota)->get() as $tam) 
        {
            $tambahan+=$tam->nilai;
        }
        // dd($tambahan);

        //agregasi
        $j_atp=$absen+$piket+$panitia+$tambahan;
        return ( ( ($j_atp+($n*30))/($n*30) )*100 );
    }

}
