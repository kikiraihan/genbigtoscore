<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglUangKasOnBeasiswaAnggotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beasiswa_anggotas', function (Blueprint $table) {
            $table->timestamp('tgl_uang_kas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beasiswa_anggotas', function (Blueprint $table) {
            $table->dropColumn('tgl_uang_kas');
        });
    }
}
