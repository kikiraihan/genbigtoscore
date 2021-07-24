<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilaiebs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sb')->constrained('segmentbulanans')->onDelete('cascade');//FK
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
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
        Schema::dropIfExists('nilaiebs');
    }
}
