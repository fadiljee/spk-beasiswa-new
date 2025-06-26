<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

   protected $fillable = [
    'nama_universitas', 'deskripsi', 'persyaratan', 'periode_akademik',
    'statistik_penerimaan', 'logo'
];

    // Many-to-many ke DataPelamar
public function beasiswas()
{
    return $this->belongsToMany(Beasiswa::class, 'data_pelamar_universitas', 'data_pelamar_id', 'universitas_beasiswa_id');
}
public function universitas_beasiswa_1()
{
    return $this->belongsTo(Beasiswa::class, 'universitas_beasiswa_id_1');
}
public function pelamars()
{
    return $this->belongsToMany(DataPelamar::class, 'data_pelamar_universitas', 'universitas_beasiswa_id', 'data_pelamar_id');
}

public function universitas_beasiswa_2()
{
    return $this->belongsTo(Beasiswa::class, 'universitas_beasiswa_id_2');
}


}
