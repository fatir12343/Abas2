<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KesiswaanController extends Controller
{
    public function index()
{
    $currentDay = now()->day;

    // Mengambil data kelas beserta absensi siswa
    $kelasList = Kelas::with('siswa.absensi')->get();
    $totalAbsensi = Absensi::whereDay('date', $currentDay)->get();
    $totalRecords = $totalAbsensi->count();

    // Menghitung jumlah status kehadiran
    $countHadir = $totalAbsensi->where('status', 'Hadir')->count();
    $countSakitIzin = ($totalAbsensi->where('status', 'Sakit')->count()) + ($totalAbsensi->where('status', 'Izin')->count());
    $countAlfa = $totalAbsensi->where('status', 'Alfa')->count();
    $countTerlambat = $totalAbsensi->where('status', 'Terlambat')->count();
    $countTAP = $totalAbsensi->where('status', 'TAP')->count();

    // Menghitung persentase kehadiran
    $percentageHadir = ($totalRecords > 0) ? ($countHadir / $totalRecords) * 100 : 0;
    $percentageSakitIzin = ($totalRecords > 0) ? ($countSakitIzin / $totalRecords) * 100 : 0;
    $percentageAlfa = ($totalRecords > 0) ? ($countAlfa / $totalRecords) * 100 : 0;
    $percentageTerlambat = ($totalRecords > 0) ? ($countTerlambat / $totalRecords) * 100 : 0;
    $percentageTAP = ($totalRecords > 0) ? ($countTAP / $totalRecords) * 100 : 0;

    // Data per kelas untuk chart dan statistik
    $labels = [];
    $dataHadir = [];
    $dataSakitIzin = [];
    $dataAlfa = [];
    $dataTerlambat = [];
    $dataTAP = [];

    $kelasData = [];
    foreach ($kelasList as $kelas) {
        $siswaIds = $kelas->siswa->pluck('nis');
        $kelasAbsensi = Absensi::whereDay('date', $currentDay)
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

        // Menyimpan data untuk chart
        $labels[] = $kelas->tingkat . ' ' . $kelas->nama_jurusan . ' ' . $kelas->nomor_kelas;
        $dataHadir[] = $kelasHadir;
        $dataSakitIzin[] = $kelasSakitIzin;
        $dataAlfa[] = $kelasAlfa;
        $dataTerlambat[] = $kelasTerlambat;
        $dataTAP[] = $kelasTAP;

        // Menyimpan data untuk statistik per kelas
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

    // Data total siswa dan persentase tidak hadir
    $totalSiswa = Siswa::count();
    $totalTidakHadir = $totalSiswa - $countHadir;
    $percentageTidakHadir = ($totalSiswa > 0) ? ($totalTidakHadir / $totalSiswa) * 100 : 0;

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
        'labels' => json_encode($labels),  // Mengirim label kelas
        'dataHadir' => json_encode($dataHadir),
        'dataSakitIzin' => json_encode($dataSakitIzin),
        'dataAlfa' => json_encode($dataAlfa),
        'dataTerlambat' => json_encode($dataTerlambat),
        'dataTAP' => json_encode($dataTAP),
    ]);
}


public function laporanKelas(Request $request)
{
    // Ambil rentang tanggal dari request
    $startDate = $request->input('start');
    $endDate = $request->input('end');
    $tingkat = $request->input('tingkat');
    $jurusan = $request->input('jurusan');

    // Tetapkan default ke bulan saat ini jika tidak ada tanggal yang diberikan
    if (!$startDate || !$endDate) {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    $totalBusinessDays = $this->getBusinessDaysCount($startDate, $endDate);

    // Query kelas dengan filter opsional untuk tingkat dan jurusan
    $kelasQuery = Kelas::with('siswa.absensi');
    $jurusans = Jurusan::all();

    if ($tingkat) {
        $kelasQuery->where('tingkat', $tingkat);
    }

    if ($jurusan) {
        $kelasQuery->where('id_jurusan', $jurusan);
    }

    $kelasList = $kelasQuery->get();
    $kelasData = [];
    $totalPercentageHadir = 0;
    $totalClasses = count($kelasList);

    foreach ($kelasList as $kelas) {
        $siswaIds = $kelas->siswa->pluck('nis');
        $totalExpectedRecords = $totalBusinessDays * count($siswaIds);

        $kelasAbsensi = Absensi::whereBetween('date', [$startDate, $endDate])
            ->whereIn('nis', $siswaIds)
            ->get();

        $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
        $kelasSakitIzin = $kelasAbsensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
        $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
        $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

        // Hitung persentase berdasarkan total catatan yang diharapkan
        $kelasPercentageHadir = ($totalExpectedRecords > 0) ? ($kelasHadir / $totalExpectedRecords) * 100 : 0;
        $totalPercentageHadir += $kelasPercentageHadir;
        $kelasPercentageSakitIzin = ($totalExpectedRecords > 0) ? ($kelasSakitIzin / $totalExpectedRecords) * 100 : 0;
        $kelasPercentageAlfa = ($totalExpectedRecords > 0) ? ($kelasAlfa / $totalExpectedRecords) * 100 : 0;
        $kelasPercentageTerlambat = ($totalExpectedRecords > 0) ? ($kelasTerlambat / $totalExpectedRecords) * 100 : 0;
        $kelasPercentageTAP = ($totalExpectedRecords > 0) ? ($kelasTAP / $totalExpectedRecords) * 100 : 0;

        $kelasData[] = [
            'kelas_id' => $kelas->id_kelas,
            'kelas' => $kelas->tingkat . ' ' . $kelas->id_jurusan . ' ' . $kelas->nomor_kelas,
            'total' => $totalExpectedRecords,
            'jurusan' => $kelas->id_jurusan,
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

    // Hitung rata-rata persentase kehadiran untuk kelas yang difilter
    $averagePercentageHadir = ($totalClasses > 0) ? ($totalPercentageHadir / $totalClasses) : 0;

    $kelasDataCollection = collect($kelasData);

    // Paginasi data koleksi
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;
    $paginateData = new LengthAwarePaginator(
        $kelasDataCollection->forPage($currentPage, $perPage),
        $kelasDataCollection->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );

    $paginatedData = $paginateData->appends($request->only(['start', 'end', 'tingkat', 'jurusan']));

    return view('kesiswaan.laporankelas', [
        'title' => 'Dashboard',
        'kelasData' => $paginatedData,
        'averagePercentageHadir' => $averagePercentageHadir,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'jurusans' => $jurusans,
        'kelasList' => $kelasList,
        'selectedTingkat' => $tingkat,
        'selectedJurusan' => $jurusan,
    ]);
}

private function getBusinessDaysCount($startDate, $endDate)
{
    // Create a collection of dates between start and end dates
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);
    $businessDaysCount = 0;

    // Iterate through each date and check if it's a business day
    while ($start->lte($end)) {
        // Check if the day is a weekday (Monday to Friday)
        if ($start->isWeekday()) {
            $businessDaysCount++;
        }
        $start->addDay();
    }

    return $businessDaysCount;
}



public function laporanSiswa(Request $request, $kelas_id)
{
    $startDate = $request->input('start');
    $endDate = $request->input('end');

    if (!$startDate || !$endDate) {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    $kelas = Kelas::where('id_kelas', $kelas_id)->first();
    $students = Siswa::where('id_kelas', $kelas_id)->with('user')->get();
    $siswaIds = $students->pluck('nis');

    $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
        ->whereBetween('date', [$startDate, $endDate])
        ->get();

    $totalStudents = count($students);
    $attendanceCounts = [
        'Hadir' => $siswaAbsensi->where('status', 'Hadir')->count(),
        'Sakit' => $siswaAbsensi->where('status', 'Sakit')->count(),
        'Izin' => $siswaAbsensi->where('status', 'Izin')->count(),
        'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
        'Terlambat' => $siswaAbsensi->where('status', 'Terlambat')->count(),
        'TAP' => $siswaAbsensi->where('status', 'TAP')->count(),
    ];

    $studentsData = [];
    $totalPercentageHadir = 0;

    foreach ($students as $student) {
        $studentAttendance = $siswaAbsensi->where('nis', $student->nis);

        $totalAttendance = $studentAttendance->count();
        $studentData = [
            'nis' => $student->nis,
            'name' => $student->name,
            'attendancePercentages' => [],
        ];

        if ($totalAttendance > 0) {
            foreach ($attendanceCounts as $status => $count) {
                $studentStatusCount = $studentAttendance->where('status', $status)->count();
                $percentage = ($studentStatusCount / $totalAttendance) * 100;
                $studentData['attendancePercentages'][$status] = $percentage;
            }
            // Hitung total persentase hadir untuk rata-rata
            $totalPercentageHadir += $studentData['attendancePercentages']['Hadir'] ?? 0;
        } else {
            $studentData['attendancePercentages'] = array_fill_keys(array_keys($attendanceCounts), 0);
        }

        $studentsData[] = $studentData;
    }

    // Hitung rata-rata persentase kehadiran
    $averagePercentageHadir = ($totalStudents > 0) ? ($totalPercentageHadir / $totalStudents) : 0;

    $averageAttendancePercentages = [];
    $attendanceCounts['Sakit/Izin'] = $attendanceCounts['Sakit'] + $attendanceCounts['Izin'];

    foreach ($attendanceCounts as $status => $count) {
        $totalPercentage = 0;

        foreach ($studentsData as $studentData) {
            if ($status === 'Sakit/Izin') {
                $totalPercentage += $studentData['attendancePercentages']['Sakit'] ?? 0;
                $totalPercentage += $studentData['attendancePercentages']['Izin'] ?? 0;
            } else {
                $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
            }
        }

        $averageAttendancePercentages[$status] = $totalStudents > 0 ? $totalPercentage / $totalStudents : 0;
    }

    return view('kesiswaan.laporansiswa', compact('studentsData', 'attendanceCounts', 'averageAttendancePercentages', 'averagePercentageHadir', 'kelas', 'startDate', 'endDate'));
}


public function detailSiswa(Request $request, string $id)
{
    // Retrieve the date range from the request
    $startDate = $request->input('start');
    $endDate = $request->input('end');

    // Set default to the current month if no dates are provided
    if (!$startDate || !$endDate) {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    // Fetch attendance records with pagination, keeping the date filters
    $present = absensi::where('nis', $id)
                ->whereBetween('date', [$startDate, $endDate])
                ->orderBy('date', 'asc')
                ->paginate(5)
                ->appends($request->only(['start', 'end'])); // Keep the date range in pagination links

    // Fetch student data with relationships
    $students = siswa::where('nis', $id)->with(['user', 'kelas'])->first();

    $studentData = [
        'name' => $students->user->name,
        'nis' => $students->nis,
        'kelas' => $students->kelas->tingkat . $students->kelas->id_jurusan . $students->kelas->nomor_kelas
    ];

    // Fetch attendance counts based on status using the same filters
    $attendanceCounts = [
        'Hadir' => absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->where('status', 'Hadir')->count(),
        'Sakit/Izin' => absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->whereIn('status', ['Sakit', 'Izin'])->count(),
        'Alfa' => absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->where('status', 'Alfa')->count(),
        'Terlambat' => absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->where('status', 'Terlambat')->count(),
        'TAP' => absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->where('status', 'TAP')->count(),
    ];

    // Total attendance records in the current filtered range
    $totalRecords = absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->count();

    // Attendance percentage calculations
    $attendancePercentage = [
        'percentageHadir' => ($totalRecords > 0) ? ($attendanceCounts['Hadir'] / $totalRecords) * 100 : 0,
        'percentageSakitIzin' => ($totalRecords > 0) ? ($attendanceCounts['Sakit/Izin'] / $totalRecords) * 100 : 0,
        'percentageAlfa' => ($totalRecords > 0) ? ($attendanceCounts['Alfa'] / $totalRecords) * 100 : 0,
        'percentageTerlambat' => ($totalRecords > 0) ? ($attendanceCounts['Terlambat'] / $totalRecords) * 100 : 0,
        'percentageTAP' => ($totalRecords > 0) ? ($attendanceCounts['TAP'] / $totalRecords) * 100 : 0,
    ];

    // Return view with data
    return view('kesiswaan.detailsiswa', compact('present', 'studentData', 'attendanceCounts', 'attendancePercentage', 'startDate', 'endDate'));
}

//   public function jurusan()
//   {
//    $jurusan = jurusan::all();
//    return redirect('kesiswaan.kesiswaan',status: compact('jurusan'));
//   }
}
