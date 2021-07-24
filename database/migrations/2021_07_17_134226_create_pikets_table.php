<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sb')->constrained('segmentbulanans')->onDelete('cascade');//FK
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->integer('bobot')->default(-2);//->enum('bobot',[-5,-3,-2])
            $table->integer('jumlah_tidak_hadir');
            $table->integer('jumlah_izin');
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
        Schema::dropIfExists('pikets');
    }
}
