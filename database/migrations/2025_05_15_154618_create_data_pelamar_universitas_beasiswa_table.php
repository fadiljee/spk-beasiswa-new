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
        Schema::create('data_pelamar_universitas_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pelamar_id')->constrained('data_pelamar')->onDelete('cascade');
            $table->foreignId('universitas_beasiswa_id')->constrained('beasiswa', indexName: 'dp_univ_beasiswa_univ_id_fk')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelamar_universitas_beasiswa');
    }
};
