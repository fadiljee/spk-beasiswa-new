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
        Schema::table('data_pelamar', function (Blueprint $table) {
            if (Schema::hasColumn('data_pelamar', 'universitas_beasiswa_id')) {
                $table->dropForeign(['universitas_beasiswa_id']);
                $table->dropColumn('universitas_beasiswa_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pelamar', function (Blueprint $table) {
            if (!Schema::hasColumn('data_pelamar', 'universitas_beasiswa_id')) {
                $table->foreignId('universitas_beasiswa_id')
                    ->nullable()
                    ->constrained('beasiswa')
                    ->onDelete('cascade');
            }
        });
    }
};
