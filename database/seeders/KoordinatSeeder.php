<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\koordinat_sekolah;

class KoordinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koordinat_Sekolah::create([
            'titik_koordinat' => '-6.890510233555621, 107.55832822384018',
            'radius' => '1500',
        ]);
    }
}
