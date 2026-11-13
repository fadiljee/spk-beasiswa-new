<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('transkrip_nilai_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelamar');
    }
};
