<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('data_pelamar', function (Blueprint $table) {
        $table->string('status_lulus')->nullable(); // 'lulus' / 'tidak_lulus' / null
        $table->year('tahun_lulus')->nullable();
        $table->year('tahun_tidak_lulus')->nullable();
    });
}
public function down()
{
    Schema::table('data_pelamar', function (Blueprint $table) {
        $table->dropColumn(['status_lulus', 'tahun_lulus', 'tahun_tidak_lulus']);
    });
}

};
