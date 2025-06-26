<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataMahasiswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model
    protected $table = 'mahasiswa';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'email',
    ];
}
