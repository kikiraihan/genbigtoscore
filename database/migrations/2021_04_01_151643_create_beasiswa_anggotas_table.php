<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswa_anggotas', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->foreignId('id_beasiswa')->constrained('beasiswas')->onDelete('cascade');//FK
            $table->primary(['id_beasiswa','id_anggota']);
            

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
        Schema::dropIfExists('beasiswa_anggotas');
    }
}
