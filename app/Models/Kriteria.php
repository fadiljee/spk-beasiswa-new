<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'kriterias';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'jenis',
    ];

   /**
    * Mendefinisikan relasi ke Subkriteria.
    * Nama fungsi diubah menjadi jamak 'subkriterias' agar cocok dengan
    * pemanggilan @foreach($kriteria->subkriterias) di view.
    */
    public function subkriteria(): HasMany
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    }
}
