<?php

namespace Database\Seeders;


use App\Models\Wali_kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class WaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        wali_kelas::create([
            'nip' => '198005052022011001',
            'id_user' => 5,
            'jenis_kelamin' => 'laki laki',
            'nuptk' => '1234567890123456',
        ]);

        wali_kelas::create([
            'nip' => '198107062022021002',
            'id_user' => 6,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '2345678901234567',
        ]);

        wali_kelas::create([
            'nip' => '198209072022031003',
            'id_user' => 7,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '3456789012345678',
        ]);
    }
}
