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
        case 'ortu':
            return 'ortu';
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
    Route::get('/profile', [App\Http\Controllers\siswacontroller::class, 'profile'])->name('profile');
    Route::put('/update-profile', [App\Http\Controllers\siswacontroller::class, 'updateprofile'])->name('update-profile');
    Route::post('/ambil-absen', [App\Http\Controllers\siswacontroller::class, 'store'])->name('ambil-absen');
    Route::post('/upload-file', [App\Http\Controllers\SiswaController::class, 'uploadfile'])->name('upload-file');
});

Route::middleware(['auth', 'operator:operator'])->group(function () {
    //operator

    Route::get('/operator', [operator::class, 'index'])->name('rator');

    //wali
    Route::get('/pp', [operator::class, 'wali'])->name('walikelas');
    Route::get('/operator/wali/create', [operator::class, 'createWali'])->name('operator.wali.create');
    Route::post('/operator/wali', [operator::class, 'storeWali'])->name('operator.wali.store');
    Route::get('/operator/wali/{nuptk}/edit', [operator::class, 'editWali'])->name('operator.wali.edit');
    Route::put('/operator/wali/{id}', [operator::class, 'updateWali'])->name('operator.wali.update');
    Route::delete('/operator/wali/{nuptk}', [operator::class, 'destroyWali'])->name('operator.wali.destroy');
    //kelas
    Route::get('/qq', [operator::class, 'kelas'])->name('kelas');
    Route::post('kelas', [operator::class, 'storeKelas'])->name('kelas.store');
    Route::get('kelas/{kelas}/edit', [operator::class, 'edit'])->name('kelas.edit');
    Route::put('kelas/{kelas}', [operator::class, 'update'])->name('kelas.update');
    Route::delete('kelas/{kelas}', [operator::class, 'destroy'])->name('kelas.destroy');
    Route::post('/kelas/import', [operator::class, 'import'])->name('kelas.import');
    //jurusan
    Route::get('/oo',[operator::class, 'jurusan'])->name('jurusan');
    Route::post('/jurusan',[operator::class, 'storejurusan'])->name('jurusan.store');
    Route::put('jurusan/{jurusan}',[operator::class, 'updatejurusan'])->name('jurusan.update');
    Route::delete('jurusan/{jurusan}',[operator::class, 'destroyjurusan'])->name('jurusan.destroy');
    //Siswa
    Route::get('/siswa/{id}',[operator::class, 'siswa'])->name('siswa');
    Route::post('/siswa/post',[operator::class, 'storesiswa'])->name('siswa.store');
    Route::put('siswa/id/{id}',[operator::class, 'updatesiswa'])->name('siswa.update');
    Route::delete('/siswa',[operator::class, 'destroysiswa'])->name('siswa.destroy');
    //kesiswaan
    Route::get('/kesiswaan', [operator::class, 'kesiswaan'])->name('kesiswaan');
    Route::post('/upkesiswaan', [operator::class, 'storekesiswaan'])->name('kesiswaan.store');
    Route::put('/kesiswaan/{id}', [operator::class, 'updatekesiswaan'])->name('kesiswaan.update');
    Route::delete('/kesiswaan/delete/{id}', [operator::class, 'destroykesiswaan'])->name('kesiswaan.destroy');
    //wali_siswa
    Route::get('/walisiswa', [operator::class, 'walis'])->name('walisiswa');
    Route::post('/walis', [operator::class, 'storewalis'])->name('walis.store');
    Route::put('/walis/{id}', [operator::class, 'updatewalis'])->name('walis.update');
    Route::delete('/walis/{id}', [operator::class, 'destroywalis'])->name('walis.destroy');
    //setting koordinat dan waktu
    Route::post('/updatelokasisekolah', [operator::class, 'updatelokasisekolah'])->name('updatelokasi');
    Route::post('/updatewaktu', [operator::class, 'updatewaktu'])->name('updatewaktu');
});

Route::middleware(['auth', 'kesiswaan:kesiswaan'])->group(function () {
    Route::get('/kesiswaan', [App\Http\Controllers\kesiswaan::class, 'index'])->name('kesiswaan');
    Route::get('/kesiswaan/filter', [App\Http\Controllers\kesiswaan::class, 'index'])->name('kesiswaan.filter');
});

Route::middleware(['auth', 'wali:wali'])->group(function () {
    Route::get('/wali', [App\Http\Controllers\wali::class, 'index'])->name('wali');

});

Route::middleware(['auth', 'walis:walis'])->group(function () {
    Route::get('/walis', [App\Http\Controllers\walis::class, 'index'])->name('walis');
    Route::get('/profile', [App\Http\Controllers\walis::class, 'profile'])->name('profile');
    Route::put('/update-profile', [App\Http\Controllers\walis::class, 'updateprofile'])->name('update-profile');

});

