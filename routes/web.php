<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\operator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     if (auth()->check()) {
//         $role = auth()->user()->role;

//         if ($role == 'kesiswaan') {
//             return redirect('kesiswaan');
//         } elseif ($role == 'siswa') {
//             return redirect('siswa');
//         } elseif ($role == 'wali') {
//             return redirect('wali');
//         } elseif ($role == 'operator') {
//             return redirect('operator');
//         } elseif ($role == 'walis'){
//             return redirect('walis');
//         } else {
//             return redirect('/home');
//         }



//     }
//     return view('auth.login');
// });
use App\Http\Controllers\Auth\LoginController;

// Route untuk halaman utama/login
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        // Redirect sesuai role pengguna
        return redirect()->to(redirectTo($role));
    }
    return view('login-page-user'); // Tampilkan halaman login jika belum terautentikasi
})->name('log');

// Route untuk proses login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Metode untuk mengarahkan ke halaman sesuai role
function redirectTo($role)
{
    switch ($role) {
        case 'kesiswaan':
            return 'kesiswaan';
        case 'siswa':
            return 'siswa';
        case 'wali':
            return 'wali';
        case 'operator':
            return 'operator';
        case 'walis':
            return 'walis';
        default:
            return '/'; // Redirect default jika role tidak dikenali
    }
}


Route::get('/login', function () {
    return view('login-page-user'); // Menampilkan halaman login
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth', 'siswa:siswa'])->group(function () {
    Route::get('/siswa', [App\Http\Controllers\siswacontroller::class, 'index'])->name('siswa');
    Route::post('/absen', [App\Http\Controllers\siswacontroller::class, 'absen'])->name('absen');
    Route::get('/rekap', [App\Http\Controllers\siswacontroller::class, 'Rekap'])->name('rekap');
    Route::get('/profile-siswa', [App\Http\Controllers\siswacontroller::class, 'profile'])->name('profile-siswa');
    Route::put('/update-profile', [App\Http\Controllers\siswacontroller::class, 'updateprofile'])->name('update-profile');
    Route::post('/ambil-absen', [App\Http\Controllers\siswacontroller::class, 'store'])->name('ambil-absen');
    Route::post('/upload-file', [App\Http\Controllers\SiswaController::class, 'uploadfile'])->name('upload-file');
});

Route::middleware(['auth', 'operator:operator'])->group(function () {
    //operator

    Route::get('/operator', action: [App\Http\Controllers\OperatorController::class, 'index'])->name('rator');

    //wali
    Route::get('/pp', action: [App\Http\Controllers\OperatorController::class, 'wali'])->name('walikelas');
    Route::get('/operator/wali/create', [App\Http\Controllers\OperatorController::class, 'createWali'])->name('operator.wali.create');
    Route::post('/operator/wali', [App\Http\Controllers\OperatorController::class, 'storeWali'])->name('operator.wali.store');
    Route::get('/operator/wali/{nuptk}/edit', [App\Http\Controllers\OperatorController::class, 'editWali'])->name('operator.wali.edit');
    Route::put('/operator/wali/{id}', [App\Http\Controllers\OperatorController::class, 'updateWali'])->name('operator.wali.update');
    Route::delete('/operator/wali/{nuptk}', [App\Http\Controllers\OperatorController::class, 'destroyWali'])->name('operator.wali.destroy');
    Route::post('/operator/import', [App\Http\Controllers\OperatorController::class, 'importwalikelas'])->name('wali.import');
    Route::get('/formattt/export', [App\Http\Controllers\OperatorController::class, 'Formatwali'])->name('format-walikelas');

    //kelas
    Route::get('/qq', [App\Http\Controllers\OperatorController::class, 'kelas'])->name('kelas');
    Route::post('kelas', [App\Http\Controllers\OperatorController::class, 'storeKelas'])->name('kelas.store');
    Route::get('kelas/{kelas}/edit', [App\Http\Controllers\OperatorController::class, 'edit'])->name('kelas.edit');
    Route::put('kelas/{kelas}', [App\Http\Controllers\OperatorController::class, 'update'])->name('kelas.update');
    Route::delete('kelas/{kelas}', [App\Http\Controllers\OperatorController::class, 'destroy'])->name('kelas.destroy');
    Route::post('/kelas/import', [App\Http\Controllers\OperatorController::class, 'import'])->name('kelas.import');
    //jurusan
    Route::get('/oo',[App\Http\Controllers\OperatorController::class, 'jurusan'])->name('jurusan');
    Route::post('/jurusan',[App\Http\Controllers\OperatorController::class, 'storejurusan'])->name('jurusan.store');
    Route::put('jurusan/{jurusan}',[App\Http\Controllers\OperatorController::class, 'updatejurusan'])->name('jurusan.update');
    Route::delete('jurusan/{jurusan}',[App\Http\Controllers\OperatorController::class, 'destroyjurusan'])->name('jurusan.destroy');
    //Siswa
    Route::get('/siswa/{id}',[App\Http\Controllers\OperatorController::class, 'siswa'])->name('siswa');
    Route::post('/siswatambah',[App\Http\Controllers\OperatorController::class, 'storesiswa'])->name('siswa.store');
    Route::put('siswa/{id}',[App\Http\Controllers\OperatorController::class, 'updatesiswa'])->name('siswa.update');
    Route::delete('/siswa/delete/{id}',[App\Http\Controllers\OperatorController::class, 'destroysiswa'])->name('siswa.destroy');
    Route::post('/siswa/import',[App\Http\Controllers\OperatorController::class, 'importsiswa'])->name('siswa.import');
    Route::get('/formatt/export',[App\Http\Controllers\OperatorController::class, 'Formatsiswa'])->name('formatsiswa');
    //kesiswaan
    Route::get('/kesiswaann', [App\Http\Controllers\OperatorController::class, 'kesiswaan'])->name('kesiswaan.dashboard');
    Route::post('/upkesiswaan', [App\Http\Controllers\OperatorController::class, 'storekesiswaan'])->name('kesiswaan.store');
    Route::put('/kesiswaan/{id}', [App\Http\Controllers\OperatorController::class, 'updatekesiswaan'])->name('kesiswaan.update');
    Route::delete('/kesiswaan/delete/{id}', [App\Http\Controllers\OperatorController::class, 'destroykesiswaan'])->name('kesiswaan.destroy');
    //wali_siswa
    Route::get('/walisiswa', [App\Http\Controllers\OperatorController::class, 'walis'])->name('walisiswa');
    Route::get('/walisshow', [App\Http\Controllers\OperatorController::class, 'showwalis'])->name('walisshow');
    Route::post('/walistambah', [App\Http\Controllers\OperatorController::class, 'storewalis'])->name('walis.store');
    Route::get('/walis/{id}/edit', [App\Http\Controllers\OperatorController::class, 'editwalis'])->name('walis.edit');
    Route::put('/walisiswaedit', [App\Http\Controllers\OperatorController::class, 'updatewalis'])->name('walis.update');
    Route::delete('/walis/{id}', [App\Http\Controllers\OperatorController::class, 'destroywalis'])->name('walis.destroy');
    Route::post('/walis/import', [App\Http\Controllers\OperatorController::class, 'importwalisiswa'])->name('walis.import');
    Route::get('/format/export',[App\Http\Controllers\OperatorController::class, 'Formatwalisiwa'])->name('formatwalisiwa');


    //setting koordinat dan waktu
    Route::post('/updatelokasisekolah', [App\Http\Controllers\OperatorController::class, 'updatelokasisekolah'])->name('updatelokasi');
    Route::post('/updatewaktu', [App\Http\Controllers\OperatorController::class, 'updatewaktu'])->name('updatewaktu');
});

Route::middleware(['auth', 'kesiswaan:kesiswaan'])->group(function () {
    Route::get('/kesiswaan', [App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan');
    Route::get('/kesiswaan/filter', [App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan.filter');
    Route::get('/laporan-kelas', [App\Http\Controllers\KesiswaanController::class, 'laporankelas'])->name('kesiswaan.laporankelas');
    Route::get('/laporan-siswa/{kelas_id}', [App\Http\Controllers\KesiswaanController::class, 'laporansiswa'])->name('kesiswaan.laporansiswa');
    Route::get('/laporan-detailsiswa/{id}',[App\Http\Controllers\KesiswaanController::class, 'detailSiswa'])->name('kesiswaan.detailsiswa');
});

Route::middleware(['auth', 'wali:wali'])->group(function () {
    Route::get('/wali', [App\Http\Controllers\WaliController::class, 'index'])->name('wali');
    Route::get('/laporan-siswa', [App\Http\Controllers\WaliController::class, 'laporansiswa'])->name('wali.laporansiswa');
    Route::get('/laporan-detail-siswa/{id}', [App\Http\Controllers\WaliController::class, 'detailsiswa'])->name('wali.detailsiswa');
});

Route::middleware(['auth', 'walis:walis'])->group(function () {
    Route::get('/walis', [App\Http\Controllers\WalisController::class, 'index'])->name('walis');
    Route::get('laporan-siswa-Walsis', [App\Http\Controllers\WalisController::class, 'laporan'])->name('laporan-walsis');
    Route::get('/profile', [App\Http\Controllers\WalisController::class, 'profile'])->name('profile');
    Route::put('/update-profile', [App\Http\Controllers\WalisController::class, 'updateprofile'])->name('update-profile');

});

