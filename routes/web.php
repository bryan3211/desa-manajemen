<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PengaduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes dibersihkan: tidak ada duplikasi, braces seimbang, nama route tetap
| sesuai alur kerja (user.biodata, admin.pengaduan.*, user.pengaduan.* dll).
|
*/

Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/contact-us', fn() => view('contact'))->name('contact');

// VERIFIKASI EMAIL & OTP
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');

// GUEST (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Login SSO
    Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');

    // Lupa Password
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

// AUTH (sudah login)
Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/myprofile', fn() => view('myprofile'))->name('myprofile');

    // ADMIN
    Route::middleware(['cekRole:admin'])->group(function () {
        Route::get('/verifikasi', fn() => view('admin.verifikasi'))->name('admin.verifikasi');
        Route::get('/seleksi', fn() => view('admin.seleksi'))->name('admin.seleksi');
        Route::get('/pengumuman', fn() => view('admin.pengumuman'))->name('admin.pengumuman');
        Route::get('/laporan', fn() => view('admin.laporan'))->name('admin.laporan');

        // Pengaduan admin
        Route::get('/admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.pengaduan.index');
        Route::get('/admin/pengaduan/filter', [PengaduanController::class, 'adminFilter'])->name('admin.pengaduan.filter');
        Route::get('/admin/pengaduan/{id}', [PengaduanController::class, 'adminShow'])->name('admin.pengaduan.show');
        Route::put('/admin/pengaduan/{id}', [PengaduanController::class, 'adminUpdate'])->name('admin.pengaduan.update');

  // ADMIN - Data Penduduk
        Route::middleware(['auth', 'web', 'cekRole:admin'])->group(function () {
        Route::prefix('admin/penduduk')->name('admin.penduduk.')->group(function () {
        Route::get('/', 'Admin\PendudukController@index')->name('index');
        Route::get('/create', 'Admin\PendudukController@create')->name('create');
        Route::post('/', 'Admin\PendudukController@store')->name('store');
        Route::get('/{id}', 'Admin\PendudukController@show')->name('show');
        Route::get('/{id}/edit', 'Admin\PendudukController@edit')->name('edit');
        Route::put('/{id}', 'Admin\PendudukController@update')->name('update');
        Route::delete('/{id}', 'Admin\PendudukController@destroy')->name('destroy');
        Route::get('/export/csv', 'Admin\PendudukController@export')->name('export');
    });
 });

    });

    // USER
    Route::middleware(['cekRole:user'])->group(function () {
        // Biodata user (nama route user.biodata sesuai pemanggilan di view)
        Route::get('/biodata', [BiodataController::class, 'index'])->name('user.biodata');
        Route::get('/biodata/create', [BiodataController::class, 'create'])->name('user.biodata.create');
        Route::post('/biodata', [BiodataController::class, 'store'])->name('user.biodata.store');
        Route::get('/biodata/edit', [BiodataController::class, 'edit'])->name('user.biodata.edit');
        Route::put('/biodata', [BiodataController::class, 'update'])->name('user.biodata.update');

        // Halaman user lain
        Route::get('/dokumen', fn() => view('user.dokumen'))->name('user.dokumen');
        Route::get('/status', fn() => view('user.status'))->name('user.status');
        Route::get('/daftar-ulang', fn() => view('user.daftar_ulang'))->name('user.daftar_ulang');

        // Pengaduan user
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('user.pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('user.pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('user.pengaduan.store');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('user.pengaduan.show');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('user.pengaduan.destroy');
    });
});