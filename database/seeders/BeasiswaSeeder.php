<?php

namespace Database\Seeders;

use App\Models\Beasiswa;
use Illuminate\Database\Seeder;

class BeasiswaSeeder extends Seeder
{
    /**
     * Seed kampus / universitas tujuan beasiswa di Taiwan.
     */
    public function run(): void
    {
        $kampusList = [
            [
                'nama_universitas' => 'National Taiwan University (NTU)',
                'deskripsi' => 'Program beasiswa penuh dan parsial untuk studi sarjana dan pascasarjana di National Taiwan University, Taipei.',
                'persyaratan' => 'IPK minimal 3.30, sertifikat bahasa Inggris (TOEFL/IELTS) atau Mandarin (TOCFL), surat rekomendasi.',
                'periode_akademik' => '2026/2027',
                'statistik_penerimaan' => 'Kuota 40 mahasiswa internasional per tahun',
                'logo' => 'https://commons.wikimedia.org/wiki/Special:FilePath/NTU_official_text_seal_20140901.png',
            ],
            [
                'nama_universitas' => 'National Tsing Hua University (NTHU)',
                'deskripsi' => 'Beasiswa unggulan bidang sains, teknik, semikonduktor, dan humaniora di Hsinchu, Taiwan.',
                'persyaratan' => 'IPK minimal 3.25, esai rencana studi, transkrip nilai resmi, dan surat rekomendasi dosen.',
                'periode_akademik' => '2026/2027',
                'statistik_penerimaan' => 'Kuota 35 mahasiswa internasional per tahun',
                'logo' => 'https://commons.wikimedia.org/wiki/Special:FilePath/NTHU_Round_Seal.svg',
            ],
            [
                'nama_universitas' => 'National Yang Ming Chiao Tung University (NYCU)',
                'deskripsi' => 'Program beasiswa riset dan teknologi informasi serta kedokteran di NYCU, Taiwan.',
                'persyaratan' => 'IPK minimal 3.20, portofolio riset atau prestasi akademik, sertifikat bahasa Inggris.',
                'periode_akademik' => '2026/2027',
                'statistik_penerimaan' => 'Kuota 30 mahasiswa internasional per tahun',
                'logo' => 'https://commons.wikimedia.org/wiki/Special:FilePath/NYCU_(%E5%9C%8B%E7%AB%8B%E9%99%BD%E6%98%8E%E4%BA%A4%E9%80%9A%E5%A4%A7%E5%AD%B8)_Blue_Logo.png',
            ],
            [
                'nama_universitas' => 'National Taiwan University of Science and Technology (NTUST)',
                'deskripsi' => 'Beasiswa Taiwan Tech untuk bidang rekayasa terapan, desain industri, dan manajemen teknologi di Taipei.',
                'persyaratan' => 'IPK minimal 3.10, surat motivasi, ijazah & transkrip nilai dilegalisir.',
                'periode_akademik' => '2026/2027',
                'statistik_penerimaan' => 'Kuota 50 mahasiswa internasional per tahun',
                'logo' => 'https://commons.wikimedia.org/wiki/Special:FilePath/NTUST_name.svg',
            ],
            [
                'nama_universitas' => 'National Cheng Kung University (NCKU)',
                'deskripsi' => 'Beasiswa NCKU Distinguished International Student untuk studi teknik, arsitektur, dan bisnis di Tainan, Taiwan.',
                'persyaratan' => 'IPK minimal 3.15, aktif organisasi/riset, sertifikat TOEFL/IELTS.',
                'periode_akademik' => '2026/2027',
                'statistik_penerimaan' => 'Kuota 45 mahasiswa internasional per tahun',
                'logo' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Campus_of_National_Cheng_Kung_University_01.jpg',
            ],
        ];

        foreach ($kampusList as $kampus) {
            Beasiswa::updateOrCreate(
                ['nama_universitas' => $kampus['nama_universitas']],
                $kampus
            );
        }
    }
}
