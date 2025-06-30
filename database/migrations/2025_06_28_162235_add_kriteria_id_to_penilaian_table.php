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
        Schema::table('penilaian', function (Blueprint $table) {
            $table->unsignedBigInteger('kriteria_id')->after('pelamar_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            //
        });
    }
};
