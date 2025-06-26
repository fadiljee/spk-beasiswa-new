<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniversitasBeasiswaIdFromDataPelamarTable extends Migration
{
    public function up()
    {
        Schema::table('data_pelamar', function (Blueprint $table) {
            if (Schema::hasColumn('data_pelamar', 'universitas_beasiswa_id')) {
                $table->dropForeign(['universitas_beasiswa_id']); // Hapus foreign key dulu jika ada
                $table->dropColumn('universitas_beasiswa_id');
            }
        });
    }

    public function down()
    {
        Schema::table('data_pelamar', function (Blueprint $table) {
            $table->foreignId('universitas_beasiswa_id')->constrained('beasiswa')->onDelete('cascade');
        });
    }
}
