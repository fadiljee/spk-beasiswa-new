<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPelamarTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_pelamar', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('nama_lengkap');
            $table->string('jurusan')->nullable();
            $table->string('asal_universitas')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nomor_whatsapp');
            $table->text('alamat');
            // Menambahkan kolom IPK
            $table->decimal('ipk', 3, 2)->nullable();  // Tipe data decimal untuk IPK, misalnya 3.75
            // Menambahkan kolom untuk menyimpan path file transkrip nilai
            $table->string('transkrip_nilai_path')->nullable();  // Menyimpan path file transkrip nilai
            // Menambahkan kolom untuk menyimpan path file ijazah
            $table->string('ijazah_path')->nullable();  // Menyimpan path file ijazah
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('data_pelamar');
    }
}
