<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepengurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepengurusans', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->foreignId('id_unit')->constrained('units')->onDelete('cascade');//FK
            
            $table->string('jabatan',100);
            $table->char('periode',20)->nullable();
            $table->timestamp('tanggal_demisioner')->nullable();

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
        Schema::dropIfExists('kepengurusans');
    }
}
