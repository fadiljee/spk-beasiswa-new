<?php

namespace Database\Seeders;

use App\Models\Beasiswa;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Database\Seeders\Support\IndonesianPeopleGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelamarSeeder extends Seeder
{
    /**
     * Seed 1000 data_pelamar, 1000 pelamar, relasi kampus beasiswa, and penilaian.
     */
    public function run(): void
    {
        $now = now();
        $beasiswas = Beasiswa::orderBy('id')->get();
        $kampusNames = $beasiswas->pluck('nama_universitas')->all();
        $beasiswaIds = $beasiswas->pluck('id')->all();
        $kampusCount = count($beasiswaIds);

        $kriterias = Kriteria::orderBy('id')->get();
        $subkriteriaMap = [];
        foreach ($kriterias as $kriteria) {
            $subkriteriaMap[$kriteria->id] = Subkriteria::where('kriteria_id', $kriteria->id)
                ->pluck('id', 'nilai')
                ->all();
        }

        $people = IndonesianPeopleGenerator::generate(1000, $kampusNames);

        $dataPelamarRows = [];
        $pelamarRows = [];

        foreach ($people as $person) {
            $dataPelamarRows[] = [
                'email' => $person['email'],
                'nama_lengkap' => $person['name'],
                'jurusan' => $person['jurusan'],
                'asal_universitas' => $person['asal_universitas'],
                'jenis_kelamin' => $person['jenis_kelamin'],
                'tempat_lahir' => $person['tempat_lahir'],
                'tanggal_lahir' => $person['tanggal_lahir'],
                'nomor_whatsapp' => $person['nomor_whatsapp'],
                'alamat' => $person['alamat'],
                'ipk' => $person['ipk'],
                'status_lulus' => $person['status_lulus'],
                'tahun_lulus' => $person['tahun_lulus'],
                'tahun_tidak_lulus' => $person['tahun_tidak_lulus'],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $pelamarRows[] = [
                'nama_pelamar' => $person['name'],
                'email' => $person['email'],
                'jurusan' => $person['jurusan'],
                'alamat' => $person['alamat'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($dataPelamarRows, 500) as $chunk) {
            DB::table('data_pelamar')->upsert(
                $chunk,
                ['email'],
                [
                    'nama_lengkap',
                    'jurusan',
                    'asal_universitas',
                    'jenis_kelamin',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'nomor_whatsapp',
                    'alamat',
                    'ipk',
                    'status_lulus',
                    'tahun_lulus',
                    'tahun_tidak_lulus',
                    'updated_at',
                ]
            );
        }

        foreach (array_chunk($pelamarRows, 500) as $chunk) {
            DB::table('pelamar')->upsert(
                $chunk,
                ['email'],
                ['nama_pelamar', 'jurusan', 'alamat', 'updated_at']
            );
        }

        $pelamarIdByEmail = DB::table('data_pelamar')->pluck('id', 'email')->all();

        $existingPivots = [];
        foreach (DB::table('data_pelamar_universitas_beasiswa')->select('data_pelamar_id', 'universitas_beasiswa_id')->get() as $row) {
            $existingPivots["{$row->data_pelamar_id}:{$row->universitas_beasiswa_id}"] = true;
        }

        $existingPenilaian = [];
        foreach (DB::table('penilaian')->select('pelamar_id', 'kriteria_id')->get() as $row) {
            $existingPenilaian["{$row->pelamar_id}:{$row->kriteria_id}"] = true;
        }

        $pivotInserts = [];
        $penilaianInserts = [];

        foreach ($people as $person) {
            $pelamarId = $pelamarIdByEmail[$person['email']] ?? null;
            if (!$pelamarId) {
                continue;
            }

            $i = $person['index'];

            if ($kampusCount > 0) {
                $firstKampusId = $beasiswaIds[$i % $kampusCount];
                $selectedKampus = [$firstKampusId];
                if ($kampusCount > 1 && ($i % 2) === 0) {
                    $selectedKampus[] = $beasiswaIds[($i + 1) % $kampusCount];
                }

                foreach ($selectedKampus as $kampusId) {
                    $key = "{$pelamarId}:{$kampusId}";
                    if (!isset($existingPivots[$key])) {
                        $existingPivots[$key] = true;
                        $pivotInserts[] = [
                            'data_pelamar_id' => $pelamarId,
                            'universitas_beasiswa_id' => $kampusId,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            }

            foreach ($kriterias as $kIdx => $kriteria) {
                $key = "{$pelamarId}:{$kriteria->id}";
                if (isset($existingPenilaian[$key])) {
                    continue;
                }

                $nilai = (($i + $kIdx * 3) % 5) + 1;
                $subkriteriaId = $subkriteriaMap[$kriteria->id][$nilai] ?? null;
                if (!$subkriteriaId) {
                    continue;
                }

                $existingPenilaian[$key] = true;
                $penilaianInserts[] = [
                    'pelamar_id' => $pelamarId,
                    'kriteria_id' => $kriteria->id,
                    'subkriteria_id' => $subkriteriaId,
                    'nilai' => $nilai,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        foreach (array_chunk($pivotInserts, 500) as $chunk) {
            DB::table('data_pelamar_universitas_beasiswa')->insert($chunk);
        }

        foreach (array_chunk($penilaianInserts, 500) as $chunk) {
            DB::table('penilaian')->insert($chunk);
        }
    }
}
