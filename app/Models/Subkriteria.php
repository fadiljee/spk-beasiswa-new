<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriteria';
    protected $fillable = ['kriteria_id', 'nama', 'nilai'];

    // Relasi dengan Kriteria
    
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}


