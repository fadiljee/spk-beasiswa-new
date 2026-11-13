<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Seed kriteria dan subkriteria SAW.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'IPK',
                'bobot' => 30,
                'jenis' => 'Benefit',
                'subkriteria' => [
                    ['nama' => '< 2.75', 'nilai' => 1],
                    ['nama' => '2.75 - 3.00', 'nilai' => 2],
                    ['nama' => '3.01 - 3.49', 'nilai' => 3],
                    ['nama' => '3.50 - 3.74', 'nilai' => 4],
                    ['nama' => '>= 3.75', 'nilai' => 5],
                ],
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Penghasilan Orang Tua',
                'bobot' => 25,
                'jenis' => 'Cost',
                'subkriteria' => [
                    ['nama' => '< Rp 2.000.000', 'nilai' => 1],
                    ['nama' => 'Rp 2.000.000 - Rp 4.000.000', 'nilai' => 2],
                    ['nama' => 'Rp 4.000.001 - Rp 7.000.000', 'nilai' => 3],
                    ['nama' => 'Rp 7.000.001 - Rp 10.000.000', 'nilai' => 4],
                    ['nama' => '> Rp 10.000.000', 'nilai' => 5],
                ],
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Prestasi',
                'bobot' => 20,
                'jenis' => 'Benefit',
                'subkriteria' => [
                    ['nama' => 'Tidak Ada', 'nilai' => 1],
                    ['nama' => 'Tingkat Kampus', 'nilai' => 2],
                    ['nama' => 'Tingkat Regional / Provinsi', 'nilai' => 3],
                    ['nama' => 'Tingkat Nasional', 'nilai' => 4],
                    ['nama' => 'Tingkat Internasional', 'nilai' => 5],
                ],
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Keaktifan Organisasi',
                'bobot' => 15,
                'jenis' => 'Benefit',
                'subkriteria' => [
                    ['nama' => 'Tidak Aktif', 'nilai' => 1],
                    ['nama' => 'Anggota Aktif', 'nilai' => 2],
                    ['nama' => 'Koordinator Divisi', 'nilai' => 3],
                    ['nama' => 'Pengurus Inti', 'nilai' => 4],
                    ['nama' => 'Ketua / Wakil Ketua', 'nilai' => 5],
                ],
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Tanggungan Keluarga',
                'bobot' => 10,
                'jenis' => 'Benefit',
                'subkriteria' => [
                    ['nama' => '1 Orang', 'nilai' => 1],
                    ['nama' => '2 Orang', 'nilai' => 2],
                    ['nama' => '3 Orang', 'nilai' => 3],
                    ['nama' => '4 Orang', 'nilai' => 4],
                    ['nama' => '>= 5 Orang', 'nilai' => 5],
                ],
            ],
        ];

        foreach ($kriterias as $data) {
            $kriteria = Kriteria::updateOrCreate(
                ['kode_kriteria' => $data['kode_kriteria']],
                [
                    'nama_kriteria' => $data['nama_kriteria'],
                    'bobot' => $data['bobot'],
                    'jenis' => $data['jenis'],
                ]
            );

            foreach ($data['subkriteria'] as $sub) {
                Subkriteria::updateOrCreate(
                    [
                        'kriteria_id' => $kriteria->id,
                        'nama' => $sub['nama'],
                    ],
                    ['nilai' => $sub['nilai']]
                );
            }
        }
    }
}
