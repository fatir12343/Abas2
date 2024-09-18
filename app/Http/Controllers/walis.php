<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\absensi;
use App\Models\koordinat_sekolah;
use App\Models\waktu_absen;
use App\Models\wali_siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class walis extends Controller
{
    public function index()
    {
        $walisiswa = wali_siswa::where('id_user', Auth::id())->first();
        $nik = $walisiswa->siswa()->get(); // Menggunakan relasi siswa untuk mendapatkan NIK
        $hariini = date("Y-m-d");

        // Ambil data dari tabel koordinat_sekolah dan waktu_absen
        $koordinatsekolah = Koordinat_Sekolah::first();
        $jam = Waktu_Absen::first();

        // Cek absensi hari ini
        $cekabsen = Absensi::where('date', $hariini)
            ->where('nis', $nik)
            ->first();

        // Cek status izin atau sakit
        $izin = Absensi::where('nis', $nik)
            ->where('status', 'Izin')
            ->orWhere('status', 'Sakit')
            ->where('date', $hariini)
            ->first();

        // Hitung keterlambatan bulan ini dan bulan sebelumnya
        $late2 = Absensi::where('nis', $nik)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->sum('menit_keterlambatan');
        $late = Absensi::where('nis', operator: $nik)
            ->whereMonth('date', date('m'))
            ->sum('menit_keterlambatan');

        // Data absensi bulan ini dan bulan sebelumnya
        $dataBulanIni = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nik)
            ->whereMonth('date', date('m'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nik)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Gabungkan 'Sakit' dan 'Izin' menjadi satu kategori
        $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
        unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

        $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
        unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

        // Status yang tersisa
        $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
        foreach ($statuses as $status) {
            if (!array_key_exists($status, $dataBulanIni)) {
                $dataBulanIni[$status] = 0;
            }
            if (!array_key_exists($status, $dataBulanSebelumnya)) {
                $dataBulanSebelumnya[$status] = 0;
            }
        }

        $totalAbsenBulanIni = array_sum($dataBulanIni);
        $persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;

        $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
        $persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;

        // Riwayat absensi mingguan
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        $riwayatmingguini = Absensi::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('nis', $nik)
            ->get();

        // Cek status absensi
        $statusAbsen = $cekabsen ? $cekabsen->status : 'Belum Absen';
        $absenMasuk = $cekabsen ? !empty($cekabsen->photo_in) : 'Hadir';
        $absenPulang = $cekabsen ? !empty($cekabsen->photo_out) : 'Pulang';
        $statusValidasi = $statusAbsen === "Izin" || $statusAbsen === "Sakit";

        $jamskrg = date("H:i:s");
        $validasijam = $jam ? (strtotime($jamskrg) > strtotime($jam->batas_absen_pulang) || strtotime($jamskrg) < strtotime($jam->jam_absen)) : false;

        return view('walis.walis', [
            'waktu' => $jam,
            'cekabsen' => $cekabsen ? 1 : 0,
            'statusAbsen' => $statusAbsen,
            'lok_sekolah' => $koordinatsekolah,
            'siswa' => siswa::with('user')->get(),
            'jam' => $jamskrg,
            'jam_masuk' => $jam ? $jam->jam_masuk : '06:00:00',
            'jam_pulang' => $jam ? $jam->jam_pulang : '15:30:00',
            'batas_jam_masuk' => $jam ? $jam->batas_jam_masuk : null,
            'batas_jam_pulang' => $jam ? $jam->batas_jam_pulang : null,
            'dataBulanIni' => $dataBulanIni,
            'dataBulanSebelumnya' => $dataBulanSebelumnya,
            'statusIzin' => $cekabsen ? ($cekabsen->status === 'Izin' || $cekabsen->status === 'Sakit' ? 'Sudah Mengisi Izin/Sakit' : 'Belum Mengisi Izin/Sakit') : 'Belum Mengisi Izin/Sakit',
            'late' => $late,
            'late2' => $late2,
            'persentaseHadirBulanIni' => $persentaseHadirBulanIni,
            'persentaseHadirBulanSebelumnya' => $persentaseHadirBulanSebelumnya,
            'riwayatmingguini' => $riwayatmingguini,
            'statusValidasi' => $statusValidasi,
            'izin' => $izin // Mengirimkan data izin ke view
            ]);
    }
}
