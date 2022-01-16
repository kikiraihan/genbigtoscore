<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // wilayah
        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PIw";
        $sub->logo      = NULL;
        $sub->nama      ="Pengurus Inti Wilayah"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "OKE";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Organisasi dan Keanggotaan"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KK";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Kerjasama dan Kemitraan"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KWUw";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Kewirausahaan"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "APw";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Agama dan Pendidikan"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMSw";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Kesehatan Masyarakat"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 1;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "LHw";
        $sub->logo      = NULL;
        $sub->nama      ="Departemen Lingkungan Hidup"; 
        $sub->status    ="aktif"; 
        $sub->save();


        
        // UNG
        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PI-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Pengurus Inti Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "POT-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Potensi Diri Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMF-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Komunikasi dan Informasi Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KWU-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kewirausahaan Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PDK-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Pendidikan Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMS-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kesehatan Masyarakat Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 2;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "LH-UNG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Lingkungan Hidup Komisariat UNG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        // IAIN
        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PI-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Pengurus Inti Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "POT-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Potensi Diri Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMF-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Komunikasi dan Informasi Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KWU-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kewirausahaan Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PDK-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Pendidikan Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMS-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kesehatan Masyarakat Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 3;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "LH-IAIN";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Lingkungan Hidup Komisariat IAIN"; 
        $sub->status    ="aktif"; 
        $sub->save();




        // UG
        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PI-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Pengurus Inti Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KSN-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kesenian Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "AGM-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Keagamaan Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KWU-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kewirausahaan Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "PDK-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Pendidikan Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "KMS-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Kesehatan Masyarakat Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();

        $sub = new Unit;
        $sub->id_badan  = 4;
        // $sub->id_ketua  = NULL;
        $sub->singkat   = "LH-UG";
        $sub->logo      = NULL;
        $sub->nama      ="Divisi Lingkungan Hidup Komisariat UG"; 
        $sub->status    ="aktif"; 
        $sub->save();


    }
}
