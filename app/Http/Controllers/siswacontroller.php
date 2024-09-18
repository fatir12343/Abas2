<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\absensi;
use App\Models\siswa;
use App\Models\koordinat_sekolah;
use App\Models\User;
use App\Models\waktu_absen;

class siswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $user = Auth::user();
    $nis = $user->siswa->nis; // Menggunakan relasi siswa untuk mendapatkan NIS
    $hariini = date("Y-m-d");

    // Ambil data dari tabel koordinat_sekolah dan waktu_absen
    $koordinatsekolah = Koordinat_Sekolah::first();
    $jam = waktu_absen::first();

    // Cek absensi hari ini
    $cekabsen = Absensi::where('date', $hariini)
        ->where('nis', $nis)
        ->first();

    // Cek status izin atau sakit
    $izin = Absensi::where('nis', $nis)
        ->where('status', 'Izin')
        ->orWhere('status', 'Sakit')
        ->where('date', $hariini)
        ->first();

    // Hitung keterlambatan bulan ini dan bulan sebelumnya
    $late2 = Absensi::where('nis', $nis)
        ->whereMonth('date', date('m', strtotime('first day of previous month')))
        ->sum('menit_keterlambatan');
    $late = Absensi::where('nis', $nis)
        ->whereMonth('date', date('m'))
        ->sum('menit_keterlambatan');

    // Data absensi bulan ini dan bulan sebelumnya
    $dataBulanIni = Absensi::whereYear('date', date('Y'))
        ->where('nis', $nis)
        ->whereMonth('date', date('m'))
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();

    $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
        ->where('nis', $nis)
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
        ->where('nis', $nis)
        ->get();

    // Cek status absensi
    $statusAbsen = $cekabsen ? $cekabsen->status : 'Belum Absen';
    $absenMasuk = $cekabsen ? !empty($cekabsen->photo_in) : 'Hadir';
    $absenPulang = $cekabsen ? !empty($cekabsen->photo_out) : 'Pulang';
    $statusValidasi = $statusAbsen === "Izin" || $statusAbsen === "Sakit";

    $jamskrg = date("H:i:s");
    $validasijam = $jam ? (strtotime($jamskrg) > strtotime($jam->batas_absen_pulang) || strtotime($jamskrg) < strtotime($jam->jam_absen)) : false;

    return view('siswa.siswa', [
        'waktu' => $jam,
        'cekabsen' => $cekabsen ? 1 : 0,
        'statusAbsen' => $statusAbsen,
        'lok_sekolah' => $koordinatsekolah,
        'siswa' => Siswa::with('user')->get(),
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



    public function Absen()
    {
        $user = Auth::user();
        $nis = $user->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensi')->where('date', $hariini)->where('nis', $nis)->count();
        $koordinat_sekolah = DB::table('koordinat_sekolah')->where('id_koordinat_sekolah', 1)->first(); // variabel $lok_sekolah
        $waktu = DB::table('waktu_absen')->where('id_waktu_absen', 1)->first();
        return view('Siswa.absen', compact('koordinat_sekolah', 'waktu', 'cek'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = siswa::where('id_user', $user->id)->first();
        $nis = $siswa->nis;
        $date = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasiSiswa = $request->lokasi;

        // Mengambil koordinat siswa dari request
        $lokasiuser = explode(",", $lokasiSiswa);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        // Mengambil lokasi sekolah dan radius
        $lok_sekolah = Koordinat_Sekolah::first();
        $radiussekolah = $lok_sekolah->radius;
        $koordinatSekolah = explode(",", $lok_sekolah->lokasi_sekolah);
        $koordinatSekolah = [-6.89030341484189, 107.5583515530317]; // Contoh data koordinat sekolah
        if (isset($koordinatSekolah[0]) && isset($koordinatSekolah[1])) {
            $latitudeSekolah = $koordinatSekolah[0];
            $longitudeSekolah = $koordinatSekolah[1];
        } else {
            // Handle error jika koordinat tidak lengkap
            echo "Koordinat sekolah tidak lengkap.";
        }

        // Menghitung jarak siswa dari sekolah
        $jarak = $this->distance($latitudeSekolah, $longitudeSekolah, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nis . "-" . $date;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        // Ambil batas waktu masuk
        $batasMasuk = DB::table('waktu_absen')->value('batas_jam_masuk');
        // Ambil batas waktu pulang
        $batasPulang = DB::table('waktu_absen')->value('batas_jam_pulang');

        // Cek apakah siswa sudah absen masuk hari ini
        $absenHariIni = DB::table('absensi')->where('date', $date)->where('nis', $nis)->first();

        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        } elseif ($faceConfidence < 0.30) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else  {
            if ($absenHariIni) {
                // Jika sudah absen masuk, maka lakukan absen pulang
                $data_pulang = [
                    'photo_out' => $fileName,
                    'jam_pulang' => $jam,
                    'titik_koordinat_pulang' => $lokasiSiswa,
                ];

                $update = DB::table('absensi')
                    ->where('date', $date)
                    ->where('nis', $nis)
                    ->update($data_pulang);

                if ($update) {
                    Storage::put($file, $image_base64);
                    return redirect('/siswa')->with('berhasil', 'Absen pulang berhasil dicatat.');
                } else {
                    // Jika update gagal, kemungkinan data tidak ditemukan
                    return redirect('/siswa')->with('gagal', 'Absen pulang gagal. Data absensi tidak ditemukan.');
                }
            } else {
                // Jika belum absen masuk, lakukan absen masuk
                $status = ($jam > $batasMasuk) ? 'Terlambat' : 'Hadir';
                $data = [
                    'nis' => '00' . $nis,
                    'status' => $status,
                    'photo_in' => $fileName,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                ];

                $simpan = DB::table('absensi')->insert($data);
                if ($simpan) {
                    Storage::put($file, $image_base64);
                    return redirect('/siswa')->with('berhasil', 'Absen masuk berhasil dicatat.');
                } else {
                    return redirect('/siswa')->with('gagal', 'Absen masuk gagal.');
                }
            }
        }
    }

    public function Rekap(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;

        // Tentukan rentang tanggal
        $start_date = $request->input('start_date', date('Y-m-d'));
        $end_date = $request->input('end_date', date('Y-m-d'));

        // Query untuk semua data dalam rentang tanggal
        $allAbsensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->get();

        // Hitung statistik
        $stats = $this->filterrekap($allAbsensi);

        // Query dengan paginasi untuk tampilan tabel
        $absensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->paginate(7)
            ->appends($request->only(['start_date', 'end_date']));

        return view('siswa.rekap', array_merge(
            compact('absensi', 'start_date', 'end_date'),
            $stats
        ));
    }

    private function filterrekap($absensi)
    {
        $jumlahHadir = $absensi->where('status', 'Hadir')->count();
        $jumlahIzin = $absensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $jumlahTerlambat = $absensi->where('status', 'Terlambat')->count();
        $jumlahAlfa = $absensi->where('status', 'Alfa')->count();
        $jumlahTap = $absensi->where('status', 'TAP')->count();
        $totalKeterlambatan = $absensi->sum('menit_keterlambatan');

        $totalAbsensi = $absensi->count();
        $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 1000) : 0;

        return compact(
            'jumlahHadir',
            'jumlahIzin',
            'jumlahTerlambat',
            'jumlahAlfa',
            'jumlahTap',
            'totalKeterlambatan',
            'persentaseHadir'
        );
    }



    public function izin()
    {
        return view('Siswa.izin');
    }

    public function uploadfile(Request $request)
{

    if ($request->hasFile('photo_in')) {
        // Ambil data dari request
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $date = date("Y-m-d");
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');

        // Ambil file dari request
        $foto = $request->file('photo_in');

        // Menyimpan file dengan nama unik menggunakan Storage Laravel
        $extension = $foto->getClientOriginalExtension();
        $folderPath =('public/uploads/absensi/');
        $fileName = $nis . '_' . $date . '_' . $status . '.' . $extension;
        $file = $folderPath . $fileName;

        // $foto->move($folderPath, $fileName);

        // Simpan data ke database
        $data = [
            'nis' => '00' . $nis,
            'status' => $status,
            'photo_in' => $fileName,
            'keterangan' => $keterangan,
            'date' => $date,
        ];

        $simpan = Absensi::create($data);
        if ($simpan) {
            Storage::put($file, file_get_contents($foto));
            return redirect()->back()->with('berhasil', 'Kehadiran berhasil dicatat.');
            } else {
                return redirect()->route('siswa')->with('gagal', 'File tidak ada.');
            }
        }
    }

    public function profile()
    {
        $siswa = Auth::user();
        return view('siswa.profile', compact('siswa'));
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
            $folderPath = 'public/user_avatar/';

            // Simpan foto di storage
            Storage::put($folderPath . $fileName, file_get_contents($foto));

            // Jika sudah ada foto sebelumnya, hapus dulu
            if ($user->foto) {
                Storage::delete($folderPath . $user->foto);
            }

            $updateFields['foto'] = $fileName;
        }

        // Update data di database
        if (!empty($updateFields)) {
            User::where('id', $user->id)->update($updateFields);
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Berhasil di Update');

    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5200;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

