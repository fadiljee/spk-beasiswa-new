<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    //
    protected $table = 'alternatif';
    
    protected $fillable = ['nama_alternatif'];

    use HasFactory;

    // Definisikan relasi dengan Penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
