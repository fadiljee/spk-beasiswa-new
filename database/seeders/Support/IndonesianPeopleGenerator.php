<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Str;

class IndonesianPeopleGenerator
{
    private const MALE_FIRST_NAMES = [
        'Ahmad', 'Andi', 'Arif', 'Bagas', 'Bayu', 'Bima', 'Budi', 'Cahyo',
        'Dani', 'Dedi', 'Dimas', 'Dwi', 'Eko', 'Fajar', 'Farhan', 'Fikri',
        'Galih', 'Gilang', 'Hadi', 'Hafiz', 'Hendra', 'Ilham', 'Imam', 'Indra',
        'Irfan', 'Joko', 'Kurnia', 'Lukman', 'Maulana', 'Muhammad', 'Nanda',
        'Nugroho', 'Pandu', 'Prasetyo', 'Putra', 'Rafi', 'Rahmat', 'Rama',
        'Reza', 'Ridwan', 'Rizky', 'Robby', 'Rudi', 'Satria', 'Setiawan',
        'Slamet', 'Surya', 'Taufik', 'Teguh', 'Wahyu', 'Wawan', 'Yoga',
        'Yusuf', 'Zaki', 'Zulfikar',
    ];

    private const FEMALE_FIRST_NAMES = [
        'Adinda', 'Aisyah', 'Amelia', 'Ananda', 'Anggun', 'Anisa', 'Ayu', 'Bella',
        'Citra', 'Desi', 'Dewi', 'Dian', 'Dina', 'Dinda', 'Eka', 'Elsa',
        'Fadhilah', 'Farah', 'Fitri', 'Gita', 'Hana', 'Indah', 'Intan', 'Kartika',
        'Laras', 'Lestari', 'Lia', 'Maya', 'Mega', 'Melati', 'Mutiara', 'Nadia',
        'Nabila', 'Nisa', 'Novita', 'Nurul', 'Putri', 'Rahma', 'Rani', 'Ratna',
        'Rina', 'Riska', 'Salsa', 'Sari', 'Sekar', 'Shinta', 'Siti', 'Sri',
        'Suci', 'Tari', 'Tiara', 'Tri', 'Utami', 'Vina', 'Wulan',
    ];

    private const LAST_NAMES = [
        'Adriansyah', 'Akbar', 'Alamsyah', 'Anggraini', 'Anwar', 'Aprianto',
        'Ardiansyah', 'Astuti', 'Azizah', 'Budiman', 'Cahyono', 'Darmawan',
        'Fadillah', 'Firmansyah', 'Gunawan', 'Hakim', 'Handayani', 'Haryanto',
        'Hermawan', 'Hidayat', 'Hutagalung', 'Irawan', 'Iskandar', 'Jaya',
        'Kartono', 'Kurniawan', 'Kusuma', 'Laksmana', 'Lestari', 'Lubis',
        'Maharani', 'Mahendra', 'Manullang', 'Marzuki', 'Maulida', 'Mulyadi',
        'Nasution', 'Nugraha', 'Nugroho', 'Nurhadi', 'Oktaviani', 'Pangestu',
        'Permana', 'Pradana', 'Prasetyo', 'Pratama', 'Purnama', 'Purwanto',
        'Putra', 'Putri', 'Raharjo', 'Rahmadani', 'Rahmawati', 'Ramadhan',
        'Sari', 'Setiawan', 'Siregar', 'Subekti', 'Suharto', 'Suryadi',
        'Susanto', 'Sutrisno', 'Syahputra', 'Utomo', 'Wahyudi', 'Wibowo',
        'Wijaya', 'Yulianto',
    ];

    private const JURUSAN = [
        'Teknik Informatika',
        'Sistem Informasi',
        'Teknik Elektro',
        'Ilmu Komputer',
        'Manajemen',
        'Akuntansi',
        'Teknik Sipil',
        'Matematika',
        'Statistika',
        'Teknik Industri',
    ];

    private const KOTA = [
        'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang',
        'Malang', 'Medan', 'Makassar', 'Palembang', 'Depok',
        'Bogor', 'Bekasi', 'Tangerang', 'Solo', 'Denpasar',
    ];

    private const JALAN = [
        'Jl. Merdeka', 'Jl. Sudirman', 'Jl. Ahmad Yani', 'Jl. Diponegoro',
        'Jl. Gatot Subroto', 'Jl. Pemuda', 'Jl. Veteran', 'Jl. Pahlawan',
        'Jl. Kartini', 'Jl. Melati', 'Jl. Mawar', 'Jl. Kenanga',
    ];

    /**
     * Generate deterministic list of normal Indonesian people.
     *
     * @param  array<int, string>  $kampusNames
     * @return array<int, array<string, mixed>>
     */
    public static function generate(int $count = 1000, array $kampusNames = []): array
    {
        if (empty($kampusNames)) {
            $kampusNames = [
                'Universitas Indonesia (UI)',
                'Institut Teknologi Bandung (ITB)',
                'Universitas Gadjah Mada (UGM)',
                'Institut Teknologi Sepuluh Nopember (ITS)',
                'Universitas Brawijaya (UB)',
            ];
        }

        $maleCount = count(self::MALE_FIRST_NAMES);
        $femaleCount = count(self::FEMALE_FIRST_NAMES);
        $lastCount = count(self::LAST_NAMES);
        $jurusanCount = count(self::JURUSAN);
        $kotaCount = count(self::KOTA);
        $jalanCount = count(self::JALAN);
        $kampusCount = count($kampusNames);

        $people = [];
        for ($i = 1; $i <= $count; $i++) {
            $isMale = ($i % 2) === 1;
            $firstIdx = ($i * 7) % ($isMale ? $maleCount : $femaleCount);
            $lastIdx = ($i * 13 + intdiv($i, 10)) % $lastCount;

            $firstName = $isMale
                ? self::MALE_FIRST_NAMES[$firstIdx]
                : self::FEMALE_FIRST_NAMES[$firstIdx];
            $lastName = self::LAST_NAMES[$lastIdx];
            $fullName = "{$firstName} {$lastName}";

            $emailSlug = Str::slug("{$firstName}.{$lastName}", '.');
            $email = "{$emailSlug}.{$i}@example.com";

            $kota = self::KOTA[$i % $kotaCount];
            $jalan = self::JALAN[$i % $jalanCount];
            $nomor = ($i % 150) + 1;

            $birthYear = 2001 + ($i % 5);
            $birthMonth = str_pad((string) (($i % 12) + 1), 2, '0', STR_PAD_LEFT);
            $birthDay = str_pad((string) (($i % 28) + 1), 2, '0', STR_PAD_LEFT);

            $ipk = round(2.75 + (($i * 17) % 125) / 100, 2);

            $statusMod = $i % 5;
            $statusLulus = match ($statusMod) {
                0, 1, 2 => 'lulus',
                3 => 'tidak_lulus',
                default => null,
            };

            $people[] = [
                'index' => $i,
                'name' => $fullName,
                'email' => $email,
                'nim' => '21010' . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                'jurusan' => self::JURUSAN[$i % $jurusanCount],
                'asal_universitas' => $kampusNames[$i % $kampusCount],
                'jenis_kelamin' => $isMale ? 'Laki-laki' : 'Perempuan',
                'tempat_lahir' => $kota,
                'tanggal_lahir' => "{$birthYear}-{$birthMonth}-{$birthDay}",
                'nomor_whatsapp' => '0812' . str_pad((string) (10000000 + $i), 8, '0', STR_PAD_LEFT),
                'alamat' => "{$jalan} No. {$nomor}, {$kota}",
                'ipk' => $ipk,
                'status_lulus' => $statusLulus,
                'tahun_lulus' => $statusLulus === 'lulus' ? 2026 : null,
                'tahun_tidak_lulus' => $statusLulus === 'tidak_lulus' ? 2026 : null,
            ];
        }

        return $people;
    }
}
