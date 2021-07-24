<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_badan')->constrained('badans')->onDelete('cascade');//FK
            $table->foreignId('id_ketua')->nullable()->constrained('anggotas')->onDelete('cascade');//FK
            $table->char('singkat',20);
            $table->string('logo',220)->nullable();//FK
            $table->string('nama',190);
            $table->enum('status',['aktif','non-aktif']);

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
        Schema::dropIfExists('units');
    }
}
