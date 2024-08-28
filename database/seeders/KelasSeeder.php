<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kelas::create([
            'id_jurusan' => 'PPLG',
            'nomor_kelas' => 2,
            'nuptk' => '1234567890123456',
            'tingkat' => '10',
        ]);

        kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nuptk' => '2345678901234567',
            'tingkat' => '11',
        ]);

        kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nuptk' => '3456789012345678',
            'tingkat' => '12',
        ]);
    }
}
