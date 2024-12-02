<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\Wali_kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class WaliController extends Controller
{
    public function index()
    {
        // Ambil data wali kelas yang sedang login
        $user = Wali_kelas::where('id_user', auth()->id())->with('kelas')->first();

        // Cek apakah wali kelas ditemukan dan memiliki nip
        if (!$user || !$user->nip) {
            return redirect()->back()->with('error', 'Wali kelas tidak ditemukan.');
        }

        // Ambil data kelas yang dipegang oleh wali kelas
        $kelas = Kelas::where('nip', $user->nip)->first();

        // Cek apakah kelas ditemukan
        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        // Hitung jumlah siswa di kelas
        $jumlahsiswa = Siswa::where('id_kelas', $kelas->id_kelas)->count();

        // Data absensi untuk hari ini
        $harini = Absensi::where('date', date('Y-m-d'))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $count = [
            'Hadir' => $harini->where('status', 'Hadir')->count(),
            'Sakit' => $harini->where('status', 'Sakit')->count(),
            'Izin' => $harini->where('status', 'Izin')->count(),
            'Terlambat' => $harini->where('status', 'Terlambat')->count(),
            'Alfa' => $harini->where('status', 'Alfa')->count(),
            'TAP' => $harini->where('status', 'TAP')->count(),
        ];

        // Data absensi untuk bulan ini
        $bulanIni = Absensi::whereMonth('date', date('m'))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $countCurrent = [
            'Hadir' => $bulanIni->where('status', 'Hadir')->count(),
            'Sakit' => $bulanIni->where('status', 'Sakit')->count(),
            'Izin' => $bulanIni->where('status', 'Izin')->count(),
            'Terlambat' => $bulanIni->where('status', 'Terlambat')->count(),
            'Alfa' => $bulanIni->where('status', 'Alfa')->count(),
            'TAP' => $bulanIni->where('status', 'TAP')->count(),
        ];

        // Data absensi untuk bulan sebelumnya
        $bulanSebelumnya = Absensi::whereMonth('date', date('m', strtotime('-1 month')))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $countPrevious = [
            'Hadir' => $bulanSebelumnya->where('status', 'Hadir')->count(),
            'Sakit' => $bulanSebelumnya->where('status', 'Sakit')->count(),
            'Izin' => $bulanSebelumnya->where('status', 'Izin')->count(),
            'Terlambat' => $bulanSebelumnya->where('status', 'Terlambat')->count(),
            'Alfa' => $bulanSebelumnya->where('status', 'Alfa')->count(),
            'TAP' => $bulanSebelumnya->where('status', 'TAP')->count(),
        ];

        // Kirim data ke view
        return view('wali.wali', compact('user', 'kelas', 'jumlahsiswa', 'count', 'countCurrent', 'countPrevious'));
    }

    public function laporansiswa(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');
    
        // Set default date range to current month if not specified
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }
    
        // Get wali kelas data for logged-in user
        $user = Wali_Kelas::where('id_user', auth()->id())->with('kelas')->first();
        
        // Get class based on wali kelas NIP
        $kelas = Kelas::where('nip', $user->nip)->first();
        
        // Get students with their user data (for names)
        $students = Siswa::where('id_kelas', $kelas->id_kelas)
            ->with('user')
            ->get();
        
        $siswaIds = $students->pluck('nis');
    
        // Get attendance data within date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    
        // Calculate attendance statistics
        $totalStudents = $students->count();
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->where('status', 'Hadir')->count(),
            'Sakit' => $siswaAbsensi->where('status', 'Sakit')->count(),
            'Izin' => $siswaAbsensi->where('status', 'Izin')->count(),
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
            'Terlambat' => $siswaAbsensi->where('status', 'Terlambat')->count(),
            'TAP' => $siswaAbsensi->where('status', 'TAP')->count(),
        ];
    
        // Prepare student data with attendance percentages
        $studentsData = [];
    
        foreach ($students as $student) {
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);
            $totalAttendance = $studentAttendance->count();
    
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->name, // Make sure this matches your user model column name
                'attendancePercentages' => [],
            ];
    
            if ($totalAttendance > 0) {
                foreach ($attendanceCounts as $status => $count) {
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                    $percentage = ($studentStatusCount / $totalAttendance) * 100;
                    $studentData['attendancePercentages'][$status] = $percentage;
                }
            } else {
                $studentData['attendancePercentages'] = array_fill_keys(array_keys($attendanceCounts), 0);
            }
    
            $studentsData[] = $studentData;
        }
    
        // Calculate average attendance percentages
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
    
        return view('wali.laporansiswa', compact(
            'studentsData',
            'attendanceCounts',
            'averageAttendancePercentages',
            'kelas',
            'startDate',
            'endDate'
        ));
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
        return view('wali.detailsiswa', compact('present', 'studentData', 'attendanceCounts', 'attendancePercentage', 'startDate', 'endDate'));
    }

}
