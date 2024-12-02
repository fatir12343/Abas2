<?php

namespace App\Http\Controllers;

use App\Exports\Format_siswa;
use App\Exports\Format_walikelas;
use App\Exports\Format_walisiwa;
use App\Imports\KelasImport;
use App\Imports\SiswaImport;
use App\Imports\WalikelasImport;
use App\Imports\WalisiswaImport;
use App\Models\absensi;
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

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.operator');

    }
    public function wali(): View
    {

        $jenis_Kelamin = ['laki-laki','Perempuan'];
        $wali = wali_kelas::paginate(4);
        return view('operator.wali', compact('wali','jenis_Kelamin'));
    }


    public function createWali(): View
    {
        return view('operator.create_wali');
    }

    public function importwalikelas(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new WalikelasImport, $request->file('importFile'));

        return redirect()->back()->with('success', 'Data Kelas Berhasil di import.');
    }
    public function Formatwali()
    {
        return Excel::download(new Format_walikelas, 'formatwalikelas.xlsx');
    }
    public function storeWali(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'nullable|string|min:8', // Password bisa optional, tapi jika diisi minimal 8 karakter
        //     'nuptk' => 'required|string|max:255|unique:wali_kelas',
        //     'jenis_kelamin' => 'required|string|max:1',
        //     'nip' => 'nullable|string|max:255',
        // ]);
        // dd($request->all());
        if (strlen($request->password) > 0) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'wali'
            ]);

            Wali_Kelas::insert([
                'nip' => $request->nip,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nuptk' => $request->nuptk,
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'wali'
            ]);

            Wali_Kelas::insert([
                'nip' => $request->nip,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nuptk' => $request->nuptk,
            ]);
        }
        return redirect()->back()->with('success', 'Wali Kelas berhasil ditambahkan.');
    }

    // public function editWali(string $nip): View
    // {
    //     $waliKelas =wali_kelas::findOrFail(id: $nip);
    //     return view('operator.edit_wali', compact('waliKelas'));
    // }

    public function updateWali(Request $request)
    {
        DB::table('wali_kelas')->where('id_user', $request->id_user)->update([
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nuptk' => $request->nuptk,
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
        $kelas = Kelas::paginate(3);
        $id_kelas = Kelas::withCount('siswa')->get();
        $jurusan = Jurusan::all();
        $walikelas = Wali_Kelas::doesntHave('kelas')->get();
        return view('Operator.kelas', compact('kelas', 'jurusan', 'walikelas','id_kelas'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new KelasImport, $request->file('importFile'));

        return redirect()->back()->with('success', 'Data Kelas Berhasil di import.');
    }


    public function storekelas(Request $request)
    {
        // return $request;
        Kelas::create([
            'id_jurusan' => $request->input('id_jurusan'),
            'nomor_kelas' => $request->input('nomor_kelas'),
            'nip' => $request->input('nip'),
            'tingkat' => $request->input('tingkat'),
            // 'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }



    public function update(Request $request, string $id_kelas)
    {
        DB::table('kelas')->where('id_kelas', $id_kelas)->update([
            'id_jurusan' => $request->id_jurusan,
            'nomor_kelas' => $request->nomor_kelas,
            'nip' => $request->nip,
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
        $jurusan = jurusan::paginate(5);
        // $jurusan = Jurusan::all();
        return view('operator.jurusan', compact('jurusan'));
    }

    public function storejurusan(Request $request)
    {
        // dd($request->all());
        Jurusan::insert([
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
        $siswa = siswa::with('user', 'kelas')->paginate(10);
        $kelas = kelas::with('jurusan', 'walikelas')->get();

        return view('operator.siswa', compact('siswa', 'kelas'));
    }

    public function importsiswa(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('importFile'));

        return redirect()->back()->with('success', 'Data Kelas Berhasil di import.');
    }

    public function Formatsiswa()
    {
        return Excel::download(new Format_siswa, 'formatSiswa.xlsx');
    }

    public function storesiswa(Request $request)
{
    // Validasi data sebelum pemrosesan
    $request->validate([
        'id' => 'whereclause|integer',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|string|min:8',
        'nis' => 'required|numeric|unique:siswa,nis',
        'id_kelas' => 'required|exists:kelas,id', // Pastikan id_kelas valid
        'jenis_kelamin' => 'required|in:Laki laki,Perempuan', // Validasi hanya Laki-laki atau Perempuan
        'nisn' => 'nullable|numeric',
        'nik_ayah' => 'nullable|numeric',
        'nik_ibu' => 'nullable|numeric',
        'nik_wali' => 'nullable|numeric',
    ]);
    if (strlen($request->password) > 0) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'role' => 'siswa'
        ]);

        Siswa::insert([
            'nis' => $request->nis,
            'id_user' => $user->id,
            'id_kelas' => $request->id_kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'nik_ayah' => $request->nik_ayah ?? null,
            'nik_ibu' => $request->nik_ibu ?? null,
            'nik_wali' => $request->nik_wali ?? null,
        ]);
    } else {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'wali'
        ]);

        Siswa::insert([
            'nis' => $request->nis,
            'id_user' => $user->id,
            'id_kelas' => $request->id_kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'nik_ayah' => $request->nik_ayah ?? null,
            'nik_ibu' => $request->nik_ibu ?? null,
            'nik_wali' => $request->nik_wali ?? null,
        ]);
    }
    return redirect()->back()->with('success', value: 'Data Berhasil Ditambahkan!');
}


public function updatesiswa(Request $r)
{
    DB::table('siswas')->where('id_user', $r->id)->update([
        'nis' => $r->nis,
        'jenis_kelamin' => $r->jenis_kelamin,
        'nisn' => $r->nisn,
        'nik_ayah' => $r->nik_ayah ?? null,
        'nik_ibu' => $r->nik_ibu ?? null,
        'nik_wali' => $r->nik_wali ?? null,
    ]);


    //DB user
    DB::table('users')->where('id', $r->id)->update([
        'nama' => $r->name,
        'email' => $r->email,
        'password' => password_hash($r->password, PASSWORD_DEFAULT),
    ]);

    return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
}


public function destroysiswa($id)
{
    // Hapus data absensi terkait terlebih dahulu
    absensi::where('nis', siswa::where('id_user', $id)->value('nis'))->delete();

    // Hapus data siswa dan user
    siswa::where('id_user', $id)->delete();
    User::find($id)->delete();

    return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
}


    public function kesiswaan()
    {
        // $kesiswaan = kesiswaan::paginate(3);
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

    public function walis(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mengambil data wali berdasarkan pencarian
        $walis = wali_siswa::with('user')
                    ->whereHas('user', function ($query) use ($search) {
                        if ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                  ->orWhere('email', 'like', '%' . $search . '%');
                        }
                    })
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->get();

                    $walis = wali_siswa ::paginate(4);
        return view('operator.walis', compact('walis'));
    }

    public function importwalisiswa(Request $request)
    {
        $request->validate([
            'importFile' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new WalisiswaImport, $request->file('importFile'));

        return redirect()->back()->with('success', 'Data Kelas Berhasil di import.');
    }

    public function Formatwalisiwa()
    {
        return Excel::download(new Format_walisiwa, 'formatWalisiwa.xlsx');
    }
    // Simpan data wali baru
    public function storewalis(Request $r)
    {
        if(strlen($r->password) > 0)
        {
            $u = User::create([
                'name' => $r->name,
                'password' => password_hash($r->password, 'default_password'),
                'email' => $r->email,
                'role' => 'walis'
            ]);
        }
        else
        {
            $u = User::create([
                'name' => $r->name,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
                'role' => 'walis'
            ]);
        }


        $w = wali_siswa::insert([
            'nik' => $r->nik,
            'id_user' => $u->id,
            'jenis_kelamin' => $r->jenis_kelamin,
            'alamat' => $r->alamat
        ]);

        if ($u && $w)
        {
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('warning', 'Gagal Menambahkan Data');
        }
    }

    // Update data wali
    public function updatewalis(Request $r, $id)
    {
       //DB wali
       wali_siswa::where('id_user', $r->id)->update([
        'nik' => $r->nik,
        'jenis_kelamin' => $r->jenis_kelamin,
        'alamat' => $r->alamat
    ]);


    //DB user
    $user = user::where('id', $r->id)->first();

    $user->update([
        'name' => $r->name,
        'email' => $r->email,
        'password' => password_hash($r->password, PASSWORD_DEFAULT),
    ]);

    return redirect()->back()->with('success', 'Wali Siswa ' . $user->name . ' Berhasil Diedit');
}
    
    


    // Hapus data wali
    public function destroywalis($id)
    {
        $u = user::findOrFail($id);
        // $u = user::where('id', $id)->first();
        $n = $u->name;

        wali_siswa::where('id_user', $id)->delete();
        $u->delete();
        // wali_siswa::where('id_user', $id)->delete();
        // $u->delete();

        return redirect()->back()->with('success', 'Wali Siswa ' . $n . ' Berhasil Dihapus');
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
        $mulai_absen = $request->input('mulai_absen');
        $mulai_pulang = $request->input('mulai_pulang');
        $batas_absen = $request->input('batas_absen');
        $batas_pulang = $request->input('batas_pulang');

        $update = DB::table('waktu_absen')->where('id_waktu_absen', 1)
        ->update([
            'mulai_absen' => $mulai_absen,
            'mulai_pulang' => $mulai_pulang,
            'batas_absen' => $batas_absen,
            'batas_pulang' => $batas_pulang
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }
}
