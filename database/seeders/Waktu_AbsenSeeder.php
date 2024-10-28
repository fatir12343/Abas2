<?php

namespace Database\Seeders;

use App\Models\waktu_absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Waktu_AbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        waktu_absen::insert([
            'id_waktu_absen' => 1,
            'mulai_absen' => '06:00:00',
            'batas_absen' => '07:00:00',
            'mulai_pulang' => '15:00:00',
            'batas_pulang' => '17:00:00',
            'toleransi' => '00:10:00'
        ]);
    }
}
