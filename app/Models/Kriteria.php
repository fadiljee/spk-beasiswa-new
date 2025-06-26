<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

   // Di App\Models\Kriteria.php
public function subkriteria()
{
    return $this->hasMany(Subkriteria::class, 'kriteria_id');
}



    // Jika ingin menangani tipe enum dengan lebih mudah, kamu bisa menggunakan accessor atau mutator.
    // Tapi untuk kasus ini, kita biarkan enum seperti biasa karena Laravel sudah otomatis mengonversi enum.
}

