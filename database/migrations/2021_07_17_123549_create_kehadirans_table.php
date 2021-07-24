<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();

            
            $table->foreignId('id_absen')->constrained('absensis')->onDelete('cascade');//FK
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            // $table->primary(['id_anggota','id_kegiatan','id_sb']);
            
            $table->string('bukti_foto',190)->nullable();
            $table->longText('catatan')->nullable();
            $table->boolean('valid')->default(0);
            $table->foreignId('id_validator')->nullable()->constrained('anggotas')->onDelete('cascade');//FK
            
            $table->enum('kondisi',['hadir','izin','tidakhadir'])->default('hadir');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadirans');
    }
}
