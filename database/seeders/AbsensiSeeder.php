<?php

namespace Database\Seeders;

use App\Models\absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nis = '0062894371';
        $titikKoordinat = '-6.890622076541303, 107.55806983605572';

        
        
        absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'photo_in' => '0062894371_2024-08-23_masuk.png',
            'photo_out' => '0062894371_2024-08-23_keluar.png',
            'date' => '2024-07-23',
            'jam_masuk' => '06:40:00',
            'jam_pulang' => '16:40:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);

        absensi::create([
            'nis' => $nis,
            'status' => 'TAP',
            'photo_in' => '0062894371_2024-08-24_masuk.png',
            'photo_out' => '0062894371_2024-08-24_keluar.png',
            'date' => '2024-07-24',
            'jam_masuk' => '06:10:00',
            'jam_pulang' => null,
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => null,
        ]);

        absensi::create([
            'nis' => $nis,
            'status' => 'Hadir',
            'photo_in' => '0062894371_2024-08-27_masuk.png',
            'photo_out' => '0062894371_2024-08-27_keluar.png',
            'date' => '2024-07-27',
            'jam_masuk' => '06:20:00',
            'jam_pulang' => '17:00:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
        ]);
        absensi::create([
            'nis' => $nis,
            'status' => 'Alfa',
            'photo_in' => null,
            'photo_out' => null,
            'date' => '2024-07-29',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);
        absensi::create([
            'nis' => $nis,
            'status' => 'Terlambat',
            'photo_in' => '0062894371_2024-08-28_masuk.png',
            'photo_out' => '0062894371_2024-08-28_keluar.png',
            'date' => '2024-07-28',
            'jam_masuk' => '07:40:00',
            'jam_pulang' => '17:10:00',
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => $titikKoordinat,
            'menit_keterlambatan' => '43',
        ]);

        absensi::create([
            'nis' => $nis,
            'status' => 'Alfa',
            'photo_in' => null,
            'photo_out' => null,
            'date' => '2024-07-29',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'titik_koordinat_masuk' => null,
            'titik_koordinat_pulang' => null,
        ]);
        absensi::create([
            'nis' => $nis,
            'status' => 'TAP',
            'photo_in' => '0062894371_2024-08-24_masuk.png',
            'photo_out' => '0062894371_2024-08-24_keluar.png',
            'date' => '2024-07-24',
            'jam_masuk' => '06:10:00',
            'jam_pulang' => null,
            'titik_koordinat_masuk' => $titikKoordinat,
            'titik_koordinat_pulang' => null,
        ]);
    }
}
