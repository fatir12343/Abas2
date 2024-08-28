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

class siswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $nis = $user->nis;
        $hariini = date("Y-m-d");

        // Cek apakah ada absen pada hari ini
        $cek = DB::table('absensi')->where('date', $hariini)->where('nis', $nis)->first();

        $statusAbsen = 'Belum Absen';

        if ($cek) {
            if ($cek->jam_masuk && !$cek->jam_pulang) {
                $statusAbsen = 'Hadir';
            } elseif ($cek->jam_pulang) {
                $statusAbsen = 'Pulang';
            }
        }

        // Ambil waktu absen dari database
        $waktu = DB::table('waktu_absen')->where('id_waktu_absen', 1)->first();

        // Ambil lokasi sekolah
        $lok_sekolah = DB::table('koordinat_sekolah')->where('id_koordinat_sekolah', 1)->first();

        // Ambil data siswa dengan relasi user
        $siswa = Siswa::with('user')->get();

        // Cek apakah $waktu null, jika iya set nilai default
        $jam_masuk = $waktu ? $waktu->jam_masuk : '06:30:00';
        $jam_pulang = $waktu ? $waktu->jam_pulang : '15:30:00';
        $batas_jam_masuk = $waktu ? $waktu->batas_jam_masuk : '07:05:00';
        $batas_jam_pulang = $waktu ? $waktu->batas_jam_pulang : '16:30:00';

        return view('Siswa.siswa', [
            'waktu' => $waktu,
            'cek' => $cek ? 1 : 0,
            'statusAbsen' => $statusAbsen,
            'lok_sekolah' => $lok_sekolah,
            'siswa' => $siswa,
            'jam' => date("H:i:s"),
            'jam_masuk' => $jam_masuk,
            'jam_pulang' => $jam_pulang,
            'batas_jam_masuk' => $batas_jam_masuk,
            'batas_jam_pulang' => $batas_jam_pulang
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
        if (isset($koordinatSekolah[0]) && isset($koordinatSekolah[2])) {
            $latitudeSekolah = $koordinatSekolah[0];
            $longitudeSekolah = $koordinatSekolah[2];
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
                $update = DB::table('absensi')->where('date', $date)->where('nis', $nis)->update($data_pulang);
                if ($update) {
                    Storage::put($file, $image_base64);
                    return redirect('/siswa')->with('berhasil', 'Absen pulang berhasil dicatat.');
                } else {
                    return redirect('/siswa')->with('gagal', 'Absen pulang gagal.');
                }
            } else {
                // Jika belum absen masuk, lakukan absen masuk
                $status = ($jam > $batasMasuk) ? 'Terlambat' : 'Hadir';
                $data = [
                    'nis' => $nis,
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




    public function izin()
    {
        return view('Siswa.izin');
    }

    public function uploadfile(Request $request)
{
    // Validasi input
    $request->validate([
        'photo_in' => 'required|mimes:png,jpg,jpeg,pdf|max:10240', // Maksimal 10MB
        'status' => 'required|string',
        'keterangan' => 'required|string',
    ]);

    if ($request->hasFile('photo_in')) {
        // Ambil data dari request
        $user = Auth::user();
        $nis = $user->nis;
        $date = date("Y-m-d");
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');

        // Ambil file dari request
        $foto = $request->file('photo_in');

        // Menyimpan file dengan nama unik menggunakan Storage Laravel
        $extension = $foto->getClientOriginalExtension();
        $folderPath = public_path('public/uploads/absensi/');
        $fileName = $nis . '_' . $date . '_' . $status . '.' . $extension;
        $file = $folderPath . $fileName;

        // $foto->move($folderPath, $fileName);

        // Simpan data ke database
        $data = [
            'nis' => $nis,
            'status' => $status,
            'photo_in' => $fileName,
            'keterangan' => $keterangan,
            'date' => $date,
        ];

        $simpan = Absensi::create($data);
        if ($simpan) {
            Storage::put($file, file_get_contents($foto));
            return redirect()->route('siswa.siswa')->with('berhasil', 'Kehadiran berhasil dicatat.');
            } else {
                return redirect()->route('siswa.siswa')->with('gagal', 'File tidak ada.');
            }
        }
    }

    public function profile()
    {
        $siswa = Auth::user();
        return view('siswa.profile', compact('siswa'));
    }

    public function updateprofil(Request $request)
    {
        $f=false;
        $P=false;

        //password
        if ($request->password != $request->kPassword) {
            return redirect()->back()->with('failed', 'Password Berbeda');
        }
        $count = strlen($request->password);
        if ($count > 0) {
            $p = User::where('id', $request->id)->update([
                'password' => password_hash($request->password, PASSWORD_DEFAULT)
            ]);
        }

        //foto
        if ($request->hasFile('foto'))
        {
            $foto = $request->file('foto');

            $folderPath = "public/user_avatar/";

            $extension = $foto->getClientOriginalExtension();
            $fileName = $request->nis . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));

            $f= User::where('id', $request->id)->update([
                'foto' => $fileName
            ]);
        }

        // email
        $u = User::where('id', $request->id)->update([
            'email' => $request->email,
        ]);

        //redirecting
        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
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
