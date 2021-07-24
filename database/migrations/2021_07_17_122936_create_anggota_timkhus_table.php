<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTimkhusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_timkhus', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->foreignId('id_timkhu')->constrained('timkhus')->onDelete('cascade');//FK

            $table->enum('peran',[
                'kepala','anggota','pengurus-inti'
                ])->default('Anggota');
            // $table->foreignId('id_penilai')->constrained('anggotas')->onDelete('cascade');//FK
            $table->string('penilai')->nullable();
            $table->string('nilai')->default('0');//1/5dst

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
        Schema::dropIfExists('anggota_timkhus');
    }
}
