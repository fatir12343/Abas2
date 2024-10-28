<?php

namespace Database\Seeders;

use App\Models\absensi;
use App\Models\siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $dataSiswa = siswa::all()->map(function ($siswa) {
        return [
            'nis' => $siswa->nis,
            'titikKoordinat' => '-6.890622076541303, 107.55806983605572', // Koordinat yang sama untuk semua siswa
        ];
    })->toArray();
    
    // Loop untuk data absensi dalam jangka waktu 2 minggu untuk setiap siswa
    foreach ($dataSiswa as $siswa) {
        $statusList = ['Hadir', 'TAP', 'Terlambat', 'Alfa', 'Sakit']; // Status yang mungkin
        $tanggalMulai = strtotime('2024-09-26');
        $tanggalAkhir = strtotime('2024-10-06'); // 2 minggu
    
        for ($i = $tanggalMulai; $i <= $tanggalAkhir; $i = strtotime('+1 day', $i)) {
            $status = $statusList[array_rand($statusList)]; // Random status untuk variasi
            $jamMasuk = null;
            $jamPulang = null;
            $photoIn = null;
            $photoOut = null;
            $menitKeterlambatan = null;
    
            // Generate jam masuk dan keluar hanya jika status adalah 'Hadir' atau 'Terlambat'
            if ($status === 'Hadir') {
                $jamMasuk = '06:40:00';
                $jamPulang = '16:40:00';
                $photoIn = $siswa['nis'] . '_' . date('Y-m-d', $i) . '_masuk.png';
                $photoOut = $siswa['nis'] . '_' . date('Y-m-d', $i) . '_keluar.png';
            } elseif ($status === 'Terlambat') {
                $jamMasuk = '07:40:00'; // Terlambat 1 jam
                $jamPulang = '16:40:00';
                $photoIn = $siswa['nis'] . '_' . date('Y-m-d', $i) . '_masuk.png';
                $photoOut = $siswa['nis'] . '_' . date('Y-m-d', $i) . '_keluar.png';
                $menitKeterlambatan = rand(30, 60); // Random keterlambatan antara 30-60 menit
            }
    
            // Insert absensi ke database
            Absensi::create([
                'nis' => $siswa['nis'],
                'status' => $status,
                'photo_in' => $photoIn,
                'photo_out' => $photoOut,
                'date' => date('Y-m-d', $i),
                'jam_masuk' => $jamMasuk,
                'jam_pulang' => $jamPulang,
                'titik_koordinat_masuk' => ($status === 'Hadir' || $status === 'Terlambat') ? $siswa['titikKoordinat'] : null,
                'titik_koordinat_pulang' => ($status === 'Hadir' || $status === 'Terlambat') ? $siswa['titikKoordinat'] : null,
                'menit_keterlambatan' => $menitKeterlambatan,
            ]);
        }
    }
    
}

}
