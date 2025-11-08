<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact-us', function () {
    return view('contact');
});

// ===================
// VERIFIKASI EMAIL & OTP
// ===================
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');

// ===================
// UNTUK GUEST (BELUM LOGIN)
// ===================
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

// ===================
// UNTUK USER LOGIN
// ===================
Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/myprofile', fn() => view('myprofile'))->name('myprofile');

    // ===================
    // ADMIN
    // ===================
    Route::middleware(['cekRole:admin'])->group(function () {
        Route::get('/verifikasi', fn() => view('admin.verifikasi'))->name('admin.verifikasi');
        Route::get('/seleksi', fn() => view('admin.seleksi'))->name('admin.seleksi');
        Route::get('/pengumuman', fn() => view('admin.pengumuman'))->name('admin.pengumuman');
        Route::get('/laporan', fn() => view('admin.laporan'))->name('admin.laporan');
    });

    // ===================
    // USER
    // ===================
    Route::middleware(['cekRole:user'])->group(function () {

        // ==== BIODATA ====
        Route::get('/biodata', function () {
            return view('user.biodata');
        })->name('user.biodata');

        // Proses simpan biodata ke database
        Route::post('/biodata/store', [BiodataController::class, 'store'])->name('user.biodata.store');

        // ==== HALAMAN USER LAIN ====
        Route::get('/dokumen', fn() => view('user.dokumen'))->name('user.dokumen');
        Route::get('/status', fn() => view('user.status'))->name('user.status');
        Route::get('/daftar-ulang', fn() => view('user.daftar_ulang'))->name('user.daftar_ulang');
    });
});
