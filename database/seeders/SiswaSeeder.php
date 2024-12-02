<?php

namespace Database\Seeders;

use App\Models\kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\siswa;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            'nis' => '0061748352',
            'id_user' => 2,
            'id_kelas' => 1,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678901',
            'nik_ibu' => '2108410',
        ]);

        Siswa::insert([
            'nis' => '0062894371',
            'id_user' => 3,
            'id_kelas' => 2,
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678902',
            'nik_ayah' => '2108411',
        ]);

        Siswa::insert([
            'nis' => '0069584720',
            'id_user' => 4,
            'id_kelas' => 3,
            'jenis_kelamin' => 'perempuan',
            'nisn' => '0045678903',
            'nik_wali' => '2108412',
        ]);

        $faker = \Faker\Factory::create('id_ID'); // Set locale ke Indonesia
        $kelas = kelas::all();
        $jk = ['laki laki', 'perempuan'];

        foreach($kelas as $k) {
            for($i = 1; $i <= 30; $i++) {
                $random = rand(0, 1);
                $no_absen = str_pad($i, 2, '0', STR_PAD_LEFT);

                $nis = $k->id_kelas . $no_absen;
                $nisn = $k->id_kelas . $no_absen;

                $user = User::create([
                    'name' => $faker->name(), // Menggunakan Faker dengan nama Indonesia
                    'email' => 'siswa'. $i . strtolower("$k->tingkat$k->id_jurusan$k->nomor_kelas") . '@gmail.com',
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'siswa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Siswa::insert([
                    'nis'=> "006$nis$no_absen",
                    'id_user' => $user->id,
                    'jenis_kelamin' => $jk[$random],
                    'nisn' => "002024$nisn",
                    'id_kelas' => $k->id_kelas
                ]);
            }
        }



    }
}
