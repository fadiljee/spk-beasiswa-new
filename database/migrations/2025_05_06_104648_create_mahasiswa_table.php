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
        // database/migrations/xxxx_xx_xx_create_mahasiswa_table.php
            Schema::create('mahasiswa', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nim')->unique();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('jurusan');
                $table->timestamps();
            });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
