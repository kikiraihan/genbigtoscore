<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentbulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segmentbulanans', function (Blueprint $table) {
            $table->id();
            
            $table->enum('bulan', [1,2,3,4,5,6,7,8,9,10,11,12]);            
            $table->foreignId('id_beasiswa')->constrained('beasiswas')->onDelete('cascade');//FK

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
        Schema::dropIfExists('segmentbulanans');
    }
}
