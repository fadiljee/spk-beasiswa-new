<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $table = 'pelamar';
    protected $fillable = ['nama_pelamar', 'email', 'jurusan', 'alamat'];

    // Relasi dengan Penilaian (one to many)
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}


