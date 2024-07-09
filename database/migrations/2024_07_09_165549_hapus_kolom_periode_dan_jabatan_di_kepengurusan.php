<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HapusKolomPeriodeDanJabatanDiKepengurusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->dropColumn('jabatan');
            $table->dropColumn('periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->string('jabatan',100);
            $table->char('periode',20)->nullable();
        });
    }
}
