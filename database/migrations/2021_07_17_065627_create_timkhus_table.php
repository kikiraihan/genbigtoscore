<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimkhusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timkhus', function (Blueprint $table) {
            
            $table->id();
            
            $table->foreignId('id_kegiatan')->constrained('kegiatans')->onDelete('cascade');//FK
            $table->foreignId('id_kepala')->constrained('anggotas')->onDelete('cascade');//FK
            $table->foreignId('id_sb')->constrained('segmentbulanans')->onDelete('cascade');//FK

            $table->string('nama');
            $table->integer('bobot');
            $table->enum('jenis',['panitia-besar','panitia-kecil']);

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
        Schema::dropIfExists('timkhus');
    }
}
