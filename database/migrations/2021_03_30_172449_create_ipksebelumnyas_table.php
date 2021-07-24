<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpksebelumnyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipksebelumnyas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_anggota')->constrained('anggotas')->onDelete('cascade');//FK
            $table->double('ipk', 3, 2)->nullable()->default(0.00);

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
        Schema::dropIfExists('ipksebelumnyas');
    }
}
