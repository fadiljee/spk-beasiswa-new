<?php

namespace Database\Seeders;

use Database\Seeders\Support\IndonesianPeopleGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed users (admin + 1000 normal users), admin, mahasiswa (1000), and useraja (1000).
     */
    public function run(): void
    {
        $now = now();
        $defaultPassword = Hash::make('password');

        DB::table('admin')->upsert(
            [
                [
                    'email' => 'fadil@gmail.com',
                    'password' => $defaultPassword,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            ['email'],
            ['password', 'updated_at']
        );

        $people = IndonesianPeopleGenerator::generate(1000);

        $userRows = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => $defaultPassword,
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        $mahasiswaRows = [];
        $userajaRows = [];

        foreach ($people as $person) {
            $userRows[] = [
                'name' => $person['name'],
                'email' => $person['email'],
                'password' => $defaultPassword,
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $mahasiswaRows[] = [
                'nama' => $person['name'],
                'nim' => $person['nim'],
                'email' => $person['email'],
                'password' => $defaultPassword,
                'jurusan' => $person['jurusan'],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $userajaRows[] = [
                'name' => $person['name'],
                'email' => $person['email'],
                'password' => $defaultPassword,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach (array_chunk($userRows, 500) as $chunk) {
            DB::table('users')->upsert($chunk, ['email'], ['name', 'password', 'email_verified_at', 'updated_at']);
        }

        foreach (array_chunk($mahasiswaRows, 500) as $chunk) {
            DB::table('mahasiswa')->upsert($chunk, ['email'], ['nama', 'nim', 'password', 'jurusan', 'updated_at']);
        }

        foreach (array_chunk($userajaRows, 500) as $chunk) {
            DB::table('useraja')->upsert($chunk, ['email'], ['name', 'password', 'updated_at']);
        }
    }
}
