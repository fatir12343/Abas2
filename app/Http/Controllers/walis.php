<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\absensi;
use App\Models\koordinat_sekolah;
use App\Models\User;
use App\Models\waktu_absen;
use App\Models\wali_siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class walis extends Controller
{
    public function index()
    {
        
        // Dapatkan bulan dan tahun sekarang
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Dapatkan bulan dan tahun sebelumnya
        $previousMonth = now()->subMonth()->month;
        $previousYear = now()->subMonth()->year;

        // Query untuk absensi bulan ini
        $dataBulanIni = DB::table('absensi')
            ->select(DB::raw('
                SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as Hadir,
                SUM(CASE WHEN status = "Sakit/Izin" THEN 1 ELSE 0 END) as `Sakit/Izin`,
                SUM(CASE WHEN status = "Terlambat" THEN 1 ELSE 0 END) as Terlambat,
                SUM(CASE WHEN status = "TAP" THEN 1 ELSE 0 END) as TAP,
                SUM(CASE WHEN status = "Alfa" THEN 1 ELSE 0 END) as Alfa
            '))
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->first();

        // Query untuk absensi bulan sebelumnya
        $dataBulanSebelumnya = DB::table('absensi')
            ->select(DB::raw('
                SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as Hadir,
                SUM(CASE WHEN status = "Sakit/Izin" THEN 1 ELSE 0 END) as `Sakit/Izin`,
                SUM(CASE WHEN status = "Terlambat" THEN 1 ELSE 0 END) as Terlambat,
                SUM(CASE WHEN status = "TAP" THEN 1 ELSE 0 END) as TAP,
                SUM(CASE WHEN status = "Alfa" THEN 1 ELSE 0 END) as Alfa
            '))
            ->whereMonth('date', $previousMonth)
            ->whereYear('date', $previousYear)
            ->first();

        // Hitung total keterlambatan
        $totalKeterlambatan = DB::table('absensi')
            ->where('status', 'Terlambat')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('menit_keterlambatan');

        $totalKeterlambatanBulanSebelumnya = DB::table('absensi')
            ->where('status', 'Terlambat')
            ->whereMonth('date', $previousMonth)
            ->whereYear('date', $previousYear)
            ->sum('menit_keterlambatan');

        // Cek untuk menghindari division by zero
        $totalHadirBulanIni = ($dataBulanIni->Hadir + $dataBulanIni->Alfa) > 0
            ? ($dataBulanIni->Hadir / ($dataBulanIni->Hadir + $dataBulanIni->Alfa)) * 100
            : 0;

        $totalHadirBulanSebelumnya = ($dataBulanSebelumnya->Hadir + $dataBulanSebelumnya->Alfa) > 0
            ? ($dataBulanSebelumnya->Hadir / ($dataBulanSebelumnya->Hadir + $dataBulanSebelumnya->Alfa)) * 100
            : 0;

        // Kirim data ke view
        return view('walis.walis', [
            'dataBulanIni' => $dataBulanIni,
            'dataBulanSebelumnya' => $dataBulanSebelumnya,
            'totalKeterlambatan' => $totalKeterlambatan,
            'totalKeterlambatanBulanSebelumnya' => $totalKeterlambatanBulanSebelumnya,
            'persentaseHadirBulanIni' => $totalHadirBulanIni,
            'persentaseHadirBulanSebelumnya' => $totalHadirBulanSebelumnya,
        ]);
    }


    private function filterrekap($absensi)
    {
        // Mendapatkan data bulan ini
    $bulanIni = Carbon::now()->month;
    $tahunIni = Carbon::now()->year;

    $dataBulanIni = Absensi::whereMonth('tanggal', $bulanIni)
        ->whereYear('tanggal', $tahunIni)
        ->selectRaw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as Hadir')
        ->selectRaw('SUM(CASE WHEN status = "Sakit/Izin" THEN 1 ELSE 0 END) as `Sakit/Izin`')
        ->selectRaw('SUM(CASE WHEN status = "Terlambat" THEN 1 ELSE 0 END) as Terlambat')
        ->first();

    $totalKeterlambatan = Absensi::whereMonth('tanggal', $bulanIni)
        ->whereYear('tanggal', $tahunIni)
        ->where('status', 'Terlambat')
        ->sum('keterlambatan'); // Misalnya ada kolom keterlambatan dalam hitungan menit

    // Menghitung persentase kehadiran bulan ini
    $totalHariBulanIni = Carbon::now()->daysInMonth;
    $persentaseHadirBulanIni = ($dataBulanIni->Hadir / $totalHariBulanIni) * 100;

    // Mendapatkan data bulan sebelumnya
    $bulanSebelumnya = Carbon::now()->subMonth()->month;
    $tahunSebelumnya = Carbon::now()->subMonth()->year;

    $dataBulanSebelumnya = Absensi::whereMonth('tanggal', $bulanSebelumnya)
        ->whereYear('tanggal', $tahunSebelumnya)
        ->selectRaw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as Hadir')
        ->selectRaw('SUM(CASE WHEN status = "Sakit/Izin" THEN 1 ELSE 0 END) as `Sakit/Izin`')
        ->selectRaw('SUM(CASE WHEN status = "Terlambat" THEN 1 ELSE 0 END) as Terlambat')
        ->selectRaw('SUM(CASE WHEN status = "TAP" THEN 1 ELSE 0 END) as TAP')
        ->selectRaw('SUM(CASE WHEN status = "Alfa" THEN 1 ELSE 0 END) as Alfa')
        ->first();

    $totalKeterlambatanBulanSebelumnya = Absensi::whereMonth('tanggal', $bulanSebelumnya)
        ->whereYear('tanggal', $tahunSebelumnya)
        ->where('status', 'Terlambat')
        ->sum('keterlambatan');

    // Menghitung persentase kehadiran bulan sebelumnya
    $totalHariBulanSebelumnya = Carbon::create($tahunSebelumnya, $bulanSebelumnya)->daysInMonth;
    $persentaseHadirBulanSebelumnya = ($dataBulanSebelumnya->Hadir / $totalHariBulanSebelumnya) * 100;

    return ([
        'dataBulanIni' => $dataBulanIni,
        'persentaseHadirBulanIni' => $persentaseHadirBulanIni,
        'totalKeterlambatan' => $totalKeterlambatan,
        'dataBulanSebelumnya' => $dataBulanSebelumnya,
        'persentaseHadirBulanSebelumnya' => $persentaseHadirBulanSebelumnya,
        'totalKeterlambatanBulanSebelumnya' => $totalKeterlambatanBulanSebelumnya
    ]);
    }



    public function profile()
    {
        $walis = Auth::user();
        return view('walis.profile', compact('walis'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();  // Mengambil data user yang sedang login

        // Validasi data
        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed', // Password hanya diubah jika diisi dan dikonfirmasi
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateFields = [];

        // Update email
        if ($request->email !== $user->email) {
            $updateFields['email'] = $request->email;
        }

        // Update password jika diisi
        if ($request->password) {
            $updateFields['password'] = bcrypt($request->password);
        }

        // Update foto profil jika ada file yang diupload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = $user->nis . '.' . $foto->getClientOriginalExtension();
            $folderPath = 'user_avatar/';  // Tanpa 'public/' di depan

            // Simpan foto di storage/public/user_avatar/
            $foto->storeAs($folderPath, $fileName, 'public');

            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($folderPath . $user->foto)) {
                Storage::disk('public')->delete($folderPath . $user->foto);
            }

            // Update nama file foto baru ke database
            $updateFields['foto'] = $fileName;
        }

        // Update data di database jika ada perubahan
        if (!empty($updateFields)) {
            User::where('id', $user->id)->update($updateFields);
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Berhasil di Update');

    }
}
