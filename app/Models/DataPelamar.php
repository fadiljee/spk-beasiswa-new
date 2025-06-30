<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPelamar extends Model
{
    protected $table = 'data_pelamar';

    protected $fillable = [
        'email',
        'nama_lengkap',
        'jurusan',
        'asal_universitas',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_whatsapp',
        'alamat',
        'cv_path',
        'ipk',  // Menambahkan IPK
        'transkrip_nilai_path',  // Menambahkan Transkrip Nilai
        'ijazah_path',  // Menambahkan Ijazah
        'status_lulus',
        'tahun_lulus',
        'tahun_tidak_lulus',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        // Menambahkan cast untuk IPK jika perlu
        'ipk' => 'decimal:2', // Jika perlu memastikan format IPK dengan dua angka desimal
    ];

    // Many-to-many ke Beasiswa
    // public function beasiswas()
    // {
    //     return $this->belongsToMany(Beasiswa::class, 'data_pelamar_universitas', 'data_pelamar_id', 'universitas_beasiswa_id');
    // }
public function beasiswas()
{
    return $this->belongsToMany(Beasiswa::class, 'data_pelamar_universitas', 'data_pelamar_id', 'universitas_beasiswa_id');
}

    // Hubungan dengan Penilaian
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'pelamar_id');
    }

public function universitas_beasiswa_1()
{
    return $this->belongsTo(Beasiswa::class, 'universitas_beasiswa_id_1');
}

public function universitas_beasiswa_2()
{
    return $this->belongsTo(Beasiswa::class, 'universitas_beasiswa_id_2');
}



}
