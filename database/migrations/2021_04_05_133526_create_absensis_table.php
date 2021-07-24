<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            // $table->string('jenis')->nullable();//rapat/kegiatan
            $table->timestamp('date');
            $table->timestamp('deadline_absen')->nullable();
            
            // $table->foreignId('id_kegiatan')->nullable()
            // ->constrained('kegiatans')->onDelete('cascade');//FK

            $table->enum('skope',[
                'timkhu',
                'unit',
                'badan',
                'seluruh-genbi',
            ]);

            $table->string('absensiable_type',30)->nullable();
            $table->string('absensiable_id',10)->nullable();

            $table->integer('pengurangan')->default('-2');//enum('pengurangan',[-2,-3,-5])
            $table->foreignId('id_sb')->constrained('segmentbulanans')->onDelete('cascade');//FK

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
        Schema::dropIfExists('absensis');
    }
}
