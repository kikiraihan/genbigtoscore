<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTambahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tambahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sb')->constrained('segmentbulanans')->onDelete('cascade');//FK
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->string('judul',180);
            $table->integer('nilai');
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
        Schema::dropIfExists('tambahans');
    }
}
