<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaTable extends Migration

{
    
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_universitas');
            $table->text('deskripsi');
            $table->text('persyaratan')->nullable();
            $table->string('periode_akademik')->nullable();
            $table->text('statistik_penerimaan')->nullable();
            $table->string('logo')->nullable(); // Menambahkan kolom untuk logo
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('beasiswa');
    } 
};
