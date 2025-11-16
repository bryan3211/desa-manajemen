<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Penduduk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Mail\ResetPasswordMail;
use App\Mail\SendOtpMail;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string|digits:16',
            'password' => 'required|min:6',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Cari user berdasarkan NIK
        $user = User::where('nik', $request->nik)->first();

        if (!$user) {
            return back()->withErrors([
                'nik' => 'NIK tidak terdaftar dalam sistem.',
            ]);
        }

        // Attempt login
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password], $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Jika password salah
        return back()->withErrors([
            'password' => 'Password tidak sesuai.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:users,nik',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agree_terms' => 'required|accepted',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'agree_terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);

        // Cek apakah NIK ada di tabel penduduk
        $penduduk = Penduduk::where('nik', $request->nik)->first();

        if (!$penduduk) {
            return back()->withErrors([
                'nik' => 'NIK tidak ditemukan di data kependudukan desa. Silakan hubungi admin desa.',
            ])->withInput();
        }

        // Buat user baru
        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_verified' => false,
        ]);

        // Set session dengan email untuk verifikasi OTP
        $request->session()->flash('registered_email', $request->email ?? $request->nik);

        // Kirim OTP untuk verifikasi
        return $this->sendOtp($user, true); // true: from register
    }

    public function sendOtp($user = null, $fromRegister = false)
    {
        if (!$user) {
            if (Auth::check()) {
                $user = Auth::user();
            } elseif (session('verify_email')) {
                $user = User::where('email', session('verify_email'))->firstOrFail();
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Email tidak ditemukan.']);
            }
        }

        $setResendOtp = 60; // dalam detik

        if (session('last_otp_sent') && abs((int)now()->diffInSeconds(session('last_otp_sent'))) < $setResendOtp) {
            return back()->withErrors(['otp' => 'Tunggu ' . $setResendOtp . ' detik sebelum mengirim ulang OTP.']);
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->otp_code = Hash::make($otp);
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Kirim email
        $subject = 'OTP Verifikasi Email - Desa Digital';
        Mail::to($user->email ?? $user->nik . '@noemail.local')->send(new SendOtpMail(
            $subject,
            $user->name,
            $otp,
            $user->otp_expires_at->format('d M Y H:i:s')
        ));

        session([
            'verify_email' => $user->email ?? $user->nik,
            'last_otp_sent' => now(),
        ]);

        // Jika dari register, tampilkan alert success dan countdown
        if ($fromRegister) {
            return redirect()->route('verify.form')->with('success', 'Kode OTP telah dikirim ke email Anda');
        }
        // Jika dari resend, tampilkan alert success
        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Ambil user dari session (bukan dari Auth, karena user belum login)
        $user = null;
        if (session('verify_email')) {
            $user = User::where('email', session('verify_email'))
                ->orWhere('nik', session('verify_email'))
                ->first();
        }

        // Pastikan user ditemukan dan instance model
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Data verifikasi tidak ditemukan.']);
        }

        // Cek OTP dan expired
        if (!Hash::check($request->otp, $user->otp_code)) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }
        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        // Sukses verifikasi
        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Hapus session verifikasi
        session()->forget(['verify_email', 'last_otp_sent']);

        // Set session dengan registered_email
        $request->session()->flash('registered_email', $user->email ?? $user->nik);

        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi! Anda dapat login sekarang.');
    }

    public function showVerifyForm()
    {
        // Jika tidak ada session verify_email dan belum login, redirect ke login
        if (!session('verify_email') || !Auth::check()) {
            if (Auth::check()) {
                // Jika sudah login, set session verify_email jika belum ada
                $user = Auth::user();
                return $this->sendOtp($user, true);
            }

            return redirect()->route('login');
        }

        // Hitung cooldown dari session
        $cooldown = 0;
        $setResendOtp = 60;
        if (session('last_otp_sent')) {
            $diff = (int)now()->diffInSeconds(session('last_otp_sent'));
            $cooldown = abs($diff);
        }

        return view('auth.verify-email', [
            'cooldown' => $cooldown,
            'timeResendOtp' => $setResendOtp
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}