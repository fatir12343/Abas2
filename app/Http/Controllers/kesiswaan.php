<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\siswa;
use Illuminate\Http\Request;

class kesiswaan extends Controller
{
    public function index()
    {
        // Kode controller sebelumnya
        $currentDay = now()->day;
    
        $kelasList = kelas::with('siswa.absensi')->get();
        $totalAbsensi = Absensi::whereDay('date', $currentDay)->get();
        $totalRecords = $totalAbsensi->count();
    
        $countHadir = $totalAbsensi->where('status', 'Hadir')->count();
        $countSakitIzin = ($totalAbsensi->where('status', 'Sakit')->count()) + ($totalAbsensi->where('status', 'Izin')->count());
        $countAlfa = $totalAbsensi->where('status', 'Alfa')->count();
        $countTerlambat = $totalAbsensi->where('status', 'Terlambat')->count();
        $countTAP = $totalAbsensi->where('status', 'TAP')->count();
    
        $percentageHadir = ($totalRecords > 0) ? ($countHadir / $totalRecords) * 100 : 0;
        $percentageSakitIzin = ($totalRecords > 0) ? ($countSakitIzin / $totalRecords) * 100 : 0;
        $percentageAlfa = ($totalRecords > 0) ? ($countAlfa / $totalRecords) * 100 : 0;
        $percentageTerlambat = ($totalRecords > 0) ? ($countTerlambat / $totalRecords) * 100 : 0;
        $percentageTAP = ($totalRecords > 0) ? ($countTAP / $totalRecords) * 100 : 0;
    
        $kelasData = [];
        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');
            $kelasAbsensi = absensi::whereDay('date', $currentDay)
                ->whereIn('nis', $siswaIds)
                ->get();
    
            $totalKelasRecords = $kelasAbsensi->count();
            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakitIzin = ($kelasAbsensi->where('status', 'Sakit')->count()) + ($kelasAbsensi->where('status', 'Izin')->count());
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();
    
            $kelasPercentageHadir = ($totalKelasRecords > 0) ? ($kelasHadir / $totalKelasRecords) * 100 : 0;
            $kelasPercentageSakitIzin = ($totalKelasRecords > 0) ? ($kelasSakitIzin / $totalKelasRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalKelasRecords > 0) ? ($kelasAlfa / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalKelasRecords > 0) ? ($kelasTerlambat / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalKelasRecords > 0) ? ($kelasTAP / $totalKelasRecords) * 100 : 0;
    
            $kelasData[] = [
                'kelas' => $kelas->tingkat . ' ' . $kelas->nomor_kelas,
                'total' => $totalKelasRecords,
                'countHadir' => $kelasHadir,
                'percentageHadir' => $kelasPercentageHadir,
                'countSakitIzin' => $kelasSakitIzin,
                'percentageSakitIzin' => $kelasPercentageSakitIzin,
                'countAlfa' => $kelasAlfa,
                'percentageAlfa' => $kelasPercentageAlfa,
                'countTerlambat' => $kelasTerlambat,
                'percentageTerlambat' => $kelasPercentageTerlambat,
                'countTAP' => $kelasTAP,
                'percentageTAP' => $kelasPercentageTAP,
            ];
        }
    
        // Tambahan baru: Menghitung total siswa dan siswa yang tidak hadir tanpa alasan
        $totalSiswa = siswa::count(); // Total semua siswa
        $totalTidakHadir = $totalSiswa - $countHadir; // Menghitung yang tidak hadir
        $percentageTidakHadir = ($totalSiswa > 0) ? ($totalTidakHadir / $totalSiswa) * 100 : 0;
    
        // Return ke view dengan data tambahan
        return view('kesiswaan.kesiswaan', [
            'title' => 'Dashboard',
            'countHadir' => $countHadir,
            'countSakitIzin' => $countSakitIzin,
            'countAlfa' => $countAlfa,
            'countTerlambat' => $countTerlambat,
            'countTAP' => $countTAP,
            'percentageHadir' => $percentageHadir,
            'percentageSakitIzin' => $percentageSakitIzin,
            'percentageAlfa' => $percentageAlfa,
            'percentageTerlambat' => $percentageTerlambat,
            'percentageTAP' => $percentageTAP,
            'kelasData' => $kelasData,
            'totalSiswa' => $totalSiswa,
            'totalTidakHadir' => $totalTidakHadir,
            'percentageTidakHadir' => $percentageTidakHadir,
        ]);
    }
    

//   public function jurusan()
//   {
//    $jurusan = jurusan::all();
//    return redirect('kesiswaan.kesiswaan',status: compact('jurusan'));
//   }
}
