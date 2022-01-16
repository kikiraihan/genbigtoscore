<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunToSegmentbulanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('segmentbulanans', function (Blueprint $table) {
            $table->char('segtahun',10)->nullable();//tambah tahun dan nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('segmentbulanans', function (Blueprint $table) {
            $table->dropColumn('segtahun');
        });
    }
}
