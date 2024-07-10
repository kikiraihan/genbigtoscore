<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPengurusBarusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pengurus_barus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->foreignId('id_unit')->constrained('units')->onDelete('cascade')->nullable();//FK
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
        Schema::dropIfExists('form_pengurus_barus');
    }
}
