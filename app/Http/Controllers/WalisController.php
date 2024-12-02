<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\absensi;
use App\Models\User;
use App\Models\wali_siswa;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WalisController extends Controller
{
    public function index()
{
    $walisiswa = Wali_Siswa::where('id_user', Auth::user()->id)->with('user')->first();

    if ($walisiswa->jenis_kelamin == "laki laki") {
        $siswa = Siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orWhere('nik_wali', '=', $walisiswa->nik)->get();
    } elseif ($walisiswa->jenis_kelamin == "perempuan") {
        $siswa = Siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orWhere('nik_wali', '=', $walisiswa->nik)->get();
    }

    $dataAbsensiAnak = [];
    foreach ($siswa as $s) {
        $tahunIni = Absensi::where('nis', $s->nis)->whereYear('date', date('Y'))->get();
        $ini = Absensi::whereYear('date', date('Y'))->where('nis', $s->nis)->whereMonth('date', date('m'))->get();
        $lalu = Absensi::whereYear('date', date('Y'))->where('nis', $s->nis)->whereMonth('date', date('m', strtotime('first day of previous month')))->get();
        $today = Absensi::whereDate('date', today())->where('nis', $s->nis)->get();

        $jumlah = [
            'tahunIni' => $tahunIni->count(),
            'hadirTahunIni' => $tahunIni->where('status', "Hadir")->count(),
            'terlambatTahunIni' => $tahunIni->where('status', "Terlambat")->count(),
            'tapTahunIni' => $tahunIni->where('status', "TAP")->count(),
            'alfaTahunIni' => $tahunIni->where('status', "Alfa")->count(),
            'sakitIzinTahunIni' => $tahunIni->whereIn('status', ["Sakit", "Izin"])->count(),
            'menitTerlambatTahunIni' => $tahunIni->sum('menit_keterlambatan'),

            'ini' => $ini->count(),
            'hadirIni' => $ini->where('status', "Hadir")->count(),
            'terlambatIni' => $ini->where('status', "Terlambat")->count(),
            'tapIni' => $ini->where('status', "TAP")->count(),
            'alfaIni' => $ini->where('status', "Alfa")->count(),
            'sakitIzinIni' => $ini->whereIn('status', ["Sakit", "Izin"])->count(),
            'menitTerlambatBulanIni' => $ini->sum('menit_keterlambatan'),

            'lalu' => $lalu->count(),
            'hadirLalu' => $lalu->where('status', "Hadir")->count(),
            'terlambatLalu' => $lalu->where('status', "Terlambat")->count(),
            'tapLalu' => $lalu->where('status', "TAP")->count(),
            'alfaLalu' => $lalu->where('status', "Alfa")->count(),
            'sakitIzinLalu' => $lalu->whereIn('status', ["Sakit", "Izin"])->count(),
            'menitTerlambatBulanLalu' => $lalu->sum('menit_keterlambatan'),

            // 'hariini' => $today->count(),
            // 'hadirhariIni' => $today->where('status', "Hadir")->count(),
            // 'terlambathariIni' => $today->where('status', "Terlambat")->count(),
            // 'taphariIni' => $today->where('status', "TAP")->count(),
            // 'alfahariIni' => $today->where('status', "Alfa")->count(),
            // 'sakitIzinhariIni' => $today->whereIn('status', ["Sakit", "Izin"])->count(),
            // 'menitTerlambatHariIni' => $today->sum('menit_keterlambatan'),
        ];

        $persentase = [
            'PersentaseBulanIni' => $jumlah['hadirIni'] > 0 ? round(($jumlah['hadirIni'] / $jumlah['ini']) * 100, 1) : 0,
            'PersentaseBulanLalu' => $jumlah['hadirLalu'] > 0 ? round(($jumlah['hadirLalu'] / $jumlah['lalu']) * 100, 1) : 0,
            'PersentaseTahunIni' => $jumlah['hadirTahunIni'] > 0 ? round(($jumlah['hadirTahunIni'] / $jumlah['tahunIni']) * 100, 1) : 0,
            // 'PersentaseHariIni' => $jumlah['hadirhariIni'] > 0 ? round(($jumlah['hadirhariIni'] / $jumlah['hariIni']) * 100, 1) : 0,
        ];

        $dataAbsensiAnak[] = [
            'nis' => $s->nis,
            'nama' => strtolower($s->user->nama),
            'BulanIni' => [
                'Hadir' => $jumlah['hadirIni'],
                'Terlambat' => $jumlah['terlambatIni'],
                'Sakit/Izin' => $jumlah['sakitIzinIni'],
                'Alfa' => $jumlah['alfaIni'],
                'TAP' => $jumlah['tapIni'],
                'late' => $jumlah['menitTerlambatBulanIni'],
            ],
            'BulanLalu' => [
                'Hadir' => $jumlah['hadirLalu'],
                'Terlambat' => $jumlah['terlambatLalu'],
                'Sakit/Izin' => $jumlah['sakitIzinLalu'],
                'Alfa' => $jumlah['alfaLalu'],
                'TAP' => $jumlah['tapLalu'],
                'late' => $jumlah['menitTerlambatBulanLalu'],
            ],
            'TahunIni' => [
                'Hadir' => $jumlah['hadirTahunIni'],
                'Terlambat' => $jumlah['terlambatTahunIni'],
                'Sakit/Izin' => $jumlah['sakitIzinTahunIni'],
                'Alfa' => $jumlah['alfaTahunIni'],
                'TAP' => $jumlah['tapTahunIni'],
                'late' => $jumlah['menitTerlambatTahunIni'],
            ],
            // 'HariIni' => [
            //     'Hadir' => $jumlah['hadirhariIni'],
            //     'Terlambat' => $jumlah['terlambathariIni'],
            //     'Sakit/Izin' => $jumlah['sakitIzinhariIni'],
            //     'Alfa' => $jumlah['alfahariIni'],
            //     'TAP' => $jumlah['taphariIni'],
            //     'late' => $jumlah['menitTerlambatHariIni'],
            // ],
            'PersentaseBulanIni' => $persentase['PersentaseBulanIni'],
            'PersentaseBulanLalu' => $persentase['PersentaseBulanLalu'],
            'PersentaseTahunIni' => $persentase['PersentaseTahunIni'],
            // 'PersentaseHariIni' => $persentase['PersentaseHariIni'],
        ];
    }

    return view('walis.walis', compact('dataAbsensiAnak'));
}



    public function laporan(Request $request)
    {
        // dd($request->all());
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $status = $request->input('status');

        $walisiswa = Wali_Siswa::where('id_user', Auth::user()->id)->with('user')->first();

        if ($walisiswa->jenis_kelamin == "laki laki") {
            $siswa = Siswa::with('user', 'kelas')->where('nik_ayah', $walisiswa->nik)
                ->orWhere('nik_wali', $walisiswa->nik)->get();
        } elseif ($walisiswa->jenis_kelamin == "perempuan") {
            $siswa = Siswa::with('user', 'kelas')->where('nik_ibu', $walisiswa->nik)
                ->orWhere('nik_wali', $walisiswa->nik)->get();
        }

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $dataAbsensiAnak = [];
        foreach ($siswa as $s) {
            $absensiQuery = Absensi::where('nis', $s->nis)
                ->whereBetween('date', [$startDate, $endDate])
                ->orderBy('date', 'DESC');

            if ($status) {
                $absensiQuery->where('status', $status);
            }

            $absensi = $absensiQuery->get();
            $totalRecords = $absensi->count();

            // Menghitung statistik absensi
            $attendanceCounts = [
                'Hadir' => $absensi->where('status', 'Hadir')->count(),
                'Sakit/Izin' => $absensi->whereIn('status', ['Sakit', 'Izin'])->count(),
                'Alfa' => $absensi->where('status', 'Alfa')->count(),
                'Terlambat' => $absensi->where('status', 'Terlambat')->count(),
                'TAP' => $absensi->where('status', 'TAP')->count(),
            ];

            // Menghitung persentase absensi
            $attendancePercentage = [
                'percentageHadir' => ($totalRecords > 0) ? ($attendanceCounts['Hadir'] / $totalRecords) * 100 : 0,
                'percentageSakitIzin' => ($totalRecords > 0) ? ($attendanceCounts['Sakit/Izin'] / $totalRecords) * 100 : 0,
                'percentageAlfa' => ($totalRecords > 0) ? ($attendanceCounts['Alfa'] / $totalRecords) * 100 : 0,
                'percentageTerlambat' => ($totalRecords > 0) ? ($attendanceCounts['Terlambat'] / $totalRecords) * 100 : 0,
                'percentageTAP' => ($totalRecords > 0) ? ($attendanceCounts['TAP'] / $totalRecords) * 100 : 0,
            ];

            $absensiDataCollection = collect($absensi);

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 5;
            $paginateData = new LengthAwarePaginator(
                $absensiDataCollection->forPage($currentPage, $perPage),
                $absensiDataCollection->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

            $absensiData = $paginateData->appends($request->only(['start', 'end', 'status']));

            $dataAbsensiAnak[] = [
                'siswa' => $s,
                'attendanceCounts' => $attendanceCounts,
                'attendancePercentage' => $attendancePercentage,
                'absensiData' => $absensiData,
            ];
        }

        return view('walis.laporan', [
            'walisiswa' => $walisiswa,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
            'dataAbsensiAnak' => $dataAbsensiAnak,
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
