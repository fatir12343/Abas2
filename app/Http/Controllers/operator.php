<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\koordinat_sekolah;
use App\Models\waktu_absen;
use App\Models\wali_siswa;
use Illuminate\Http\Request;
use App\Models\wali_kelas;
use App\Models\kelas;
use App\Models\jurusan;
use App\Models\User;
use App\Models\siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class operator extends Controller
{
    public function index()
    {
        return view('operator.operator');

    }
    public function wali(): View
    {
        $waliKelas =wali_kelas::all();
        return view('operator.wali', compact('waliKelas'));
    }


    public function createWali(): View
    {
        return view('operator.create_wali');
    }

    public function storeWali(Request $request)
    {

        // Membuat entitas User baru
        $user = user::create([
            'name' => $request->user->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'wali',
        ]);

        // Membuat entitas WaliKelas baru yang terhubung dengan User
        wali_kelas::create([
            'nuptk' => $request->nuptk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nip' => $request->nip,
            'id_user' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Wali Kelas berhasil ditambahkan.');
    }

    public function editWali(string $nuptk): View
    {
        $waliKelas =wali_kelas::findOrFail($nuptk);
        return view('operator.edit_wali', compact('waliKelas'));
    }

    public function updateWali(Request $request)
    {
        DB::table('wali_kelas')->where('id_user', $request->id_user)->update([
            'nuptk' => $request->nuptk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nip' => $request->nip,
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'Wali Kelas berhasil diedit.');
    }

    public function destroyWali(Request $request ,$id)
    {
        $waliKelas = wali_kelas::where('id_user', $id)->first();
        // return $waliKelas;
        // $waliKelas->delete();

        $user = user::find($waliKelas->id_user);
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil di hapus.');
    }

    public function kelas()
    {
        $kelas = Kelas::with('walikelas')->get();
        $jurusan = Jurusan::all();
        $walikelas = Wali_Kelas::all();
        return view('Operator.kelas', compact('kelas', 'jurusan', 'walikelas'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new KelasImport, $request->file('importFile'));

        return redirect()->back()->with('success', 'Data Kelas Berhasil di import.');
    }
    public function create()
    {
        // $jurusan = Jurusan::all();
        // $walikelas = Wali_kelas::all();
        // return view('operator.kelas', ['jurusan' => $jurusan, 'walikelas' => $walikelas, 'action' => 'create']);
    }

    public function storekelas(Request $request)
    {
        // return $request;
        Kelas::create([
            'id_jurusan' => $request->input('id_jurusan'),
            'nomor_kelas' => $request->input('nomor_kelas'),
            'nuptk' => $request->input('nuptk'),
            'tingkat' => $request->input('tingkat'),
            // 'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    // public function show(Kelas $kelas)
    // {
    //     return view('operator.kelas', ['kelas' => $kelas, 'action' => 'show']);
    // }

    // public function edit(string $id_jurusan): View
    // {

    //     $Kelas =wali_kelas::findOrFail($id_jurusan);
    //     return view('kelas.wali', compact('kelas'));

    // }

    public function update(Request $request, string $id_kelas)
    {
        DB::table('kelas')->where('id_kelas', $id_kelas)->update([
            'id_jurusan' => $request->id_jurusan,
            'nomor_kelas' => $request->nomor_kelas,
            'nuptk' => $request->nuptk,
            'tingkat' => $request->tingkat,
            // 'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        // return $id;
        Kelas::where('id_kelas', $id)->delete();
        // $kelas->delete();

        return redirect()->back()->with('succes', 'Data Berhasi di Hapus');
    }

    public function jurusan()
    {
        $jurusan = Jurusan::all();
        return view('operator.jurusan', compact('jurusan'));
    }

    public function storejurusan(Request $request)
    {
        // dd($request->all());
        Jurusan::create([
            'id_jurusan' => $request->id_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }


    public function updatejurusan(Request $request, $id)
    {
        DB::table('jurusan')->where('id_jurusan', $id)->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroyjurusan($id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }


    public function siswa($id)
    {
        $siswa = Siswa::where('id_kelas', $id)->get();
        // $siswa = Siswa::where('id_kelas', $kelas->id_kelas)->get();
        // $siswa = Siswa::where('id_kelas', $kelas->id_kelasid)->get();
        // return $siswa;
        // $siswa = $kelas->siswa()->with('user')->get();
        // return $kelas;
        $siswa = siswa::all();

        return view('operator.siswa', compact( 'siswa'));
    }


    public function storesiswa(Request $request)
{
    // Pastikan data request tidak null dengan pengecekan sederhana
    if ($request->has(['name', 'email', 'password', 'nis', 'id_kelas', 'jenis_kelamin', 'nisn'])) {
        // Buat user baru jika semua data yang dibutuhkan tersedia
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Insert data siswa jika user berhasil dibuat
        Siswa::create([
            'nis' => $request->nis,
            'id_user' => $user->id, // Pastikan user->id adalah kolom yang benar
            'id_kelas' => $request->id_kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    // Jika data yang dibutuhkan tidak tersedia, kembali dengan pesan error
    return redirect()->back()->with('error', 'Data tidak lengkap, periksa kembali input Anda.');
}


    public function updatesiswa(Request $request, $id)
    {
        DB::table('siswa')->where('siswa_id', $request->id)->update([
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
        ]);


        //DB user
        DB::table('user')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroysiswa($id)
    {
        $siswa = User::find($id);
        $siswa->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function kesiswaan()
    {
        $kesiswaan = User::where('role', 'kesiswaan')->get();
        return view('operator.kesiswaan', compact('kesiswaan'));
    }

    public function storekesiswaan(Request  $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
        ]);

    return redirect()->back()->with('success', 'Keiswaan berhasil ditambahkan!');
    }

    public function updatekesiswaan(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroyKesiswaan($id)
    {
        $kesiswaan = User::find($id);
        $kesiswaan->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function walis()
    {
        $walis = wali_siswa::all(); // Mengambil semua data wali
        return view('operator.walis', compact('walis'));
    }

    // Simpan data wali baru
    public function storewalis(Request $request)
    {

        $nik = $request->input('nik');
        $id_user = $request->input('id_user');
        $jenis_kelamin = $request->input('jenis_kelamin');

        // Validasi manual untuk jenis_kelamin (harus 'L' atau 'P')
        if (!in_array($jenis_kelamin, ['Laki-laki', 'Perempuan'])) {
            return redirect()->back()->with('error', 'Jenis kelamin tidak valid. Harus L atau P.');
        }

        // Simpan data ke database jika valid
        wali_siswa::create([
            'nik' => $nik,
            'id_user' => $id_user,
            'jenis_kelamin' => $jenis_kelamin,
        ]);


        // Redirect dengan notifikasi
        return redirect()->back()->with('success', 'Data wali berhasil ditambahkan');
    }

    // Update data wali
    public function updatewalis(Request $request, $id)
{
    // Mencari data wali berdasarkan ID wali (misalnya id_wali)
    $wali = wali_siswa::where('id_user', $id)->firstOrFail();

    // Melakukan update data
    $wali->update([
        'nik' => $request->nik,
        'id_user' => $request->id_user,
        'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    // Redirect dengan notifikasi
    return redirect()->back()->with('success', 'Data wali berhasil diupdate');
}


    // Hapus data wali
    public function destroywalis($id)
    {
        // Mencari data wali berdasarkan ID dan menghapusnya
        wali_siswa::findOrFail($id)->delete();

        // Redirect dengan notifikasi
        return redirect()->back()->with('success', 'Data wali berhasil dihapus');
    }

    public function lokasisekolah()
    {
        $koordinat_sekolah = DB::table('koordinat__sekolah')->where('id_koordinat_sekolah', 1)->first();
        $waktu_absen = DB::table('waktu__absen')->where('id_waktu_absen', 1)->first();

        return view('operator.operator', compact('koordinat_sekolah', 'waktu_absen'));
    }
        public function updatelokasisekolah(Request $request)
        {
            $titik_koodinat = $request->input('titik_koodinat');
            $radius = $request->input('radius');

            $update = koordinat_sekolah::where('id_koordinat_sekolah', 1)->first()
                ->update([
                    'titik_koodinat' => $titik_koodinat,
                    'radius' => $radius
                ]);

            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
            }
        }

        public function updatewaktu(Request $request)
    {
        $jam_masuk = $request->input('jam_masuk');
        $jam_pulang = $request->input('jam_pulang');
        $batas_jam_masuk = $request->input('batas_jam_masuk');
        $batas_jam_pulang = $request->input('batas_jam_pulang');

        $update = DB::table('waktu_absen')->where('id_waktu_absen', 1)
        ->update([
            'jam_masuk' => $jam_masuk,
            'jam_pulang' => $jam_pulang,
            'batas_jam_masuk' => $batas_jam_masuk,
            'batas_jam_pulang' => $batas_jam_pulang
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }
}
