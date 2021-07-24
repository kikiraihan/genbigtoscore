<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');//FK
            $table->string('nama',50);
            $table->char('nim',25)->unique();
            $table->foreignId('id_universitas')->constrained('universitas')->onDelete('cascade');//FK

            // tidak wajib
            $table->foreignId('id_jurusan')->nullable()->constrained('jurusans')->onDelete('cascade');//FK
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan'])->nullable();
            $table->year('tahunmasukkuliah')->nullable();

            $table->char('no_wa',35)->nullable()->unique();
            $table->enum('agama',[
                'Islam','Kristen','Katolik','Konghuchu','Hindu','Budha','Lainnya'
                ])->nullable();
            $table->enum('golongan_darah',[
                "O",
                "A",
                "A+",
                "B",
                "B+",
                "AB",
            ])->nullable();
            // tidak wajib
            $table->timestamp('tgl_lahir')->nullable();
            $table->longText('domisili')->nullable();
            $table->longText('asal')->nullable();

            
            // relasi beasiswa berapa kali ba terima
            
            //tabel tupoksi
            //tabel sosmed
            //tabel ipksebelumnyas
            //tabel minat dan bakat
            //tabel prestasi/lomba
            
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggotas');
    }
}
