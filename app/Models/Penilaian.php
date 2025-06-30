<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

protected $fillable = [
    'pelamar_id',
    'kriteria_id',
    'subkriteria_id',
    'nilai',
];


    // Relasi ke DataPelamar
    public function pelamar()
    {
        return $this->belongsTo(DataPelamar::class, 'pelamar_id');
    }

    // Relasi ke Subkriteria
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }
}
