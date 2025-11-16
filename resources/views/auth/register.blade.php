@extends('layouts.auth')

@section('title', 'Daftar Akun - Desa Digital')

@section('content')
    <style>
        body {
            background: url('{{ asset('assets/images/my/desa-sid.png') }}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 16px;
            color: #fff;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        .card h3 {
            color: #fff;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #1abc9c;
            box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
            color: #fff;
        }

        .form-label {
            color: #f8f9fa;
        }

        .btn-primary {
            background-color: #1abc9c;
            border-color: #16a085;
        }

        .btn-primary:hover {
            background-color: #16a085;
            border-color: #149174;
        }

        .link-primary {
            color: #1abc9c !important;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .form-check-input:checked {
            background-color: #1abc9c;
            border-color: #1abc9c;
        }
    </style>

    <div class="container">
        <div class="card my-5 p-4">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <h3 class="mb-0"><b>Daftar Akun</b></h3>
                        <a href="/login" class="link-primary small">Sudah punya akun?</a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div><i class="ti ti-alert-circle me-2"></i>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <!-- NIK Input -->
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <i class="ti ti-id-badge me-2"></i>NIK (16 Digit) <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                            name="nik" placeholder="Contoh: 3515011234567890" maxlength="16" 
                            pattern="[0-9]{16}" value="{{ old('nik') }}" required autofocus>
                        <small class="text-muted d-block mt-1">
                            <i class="ti ti-info-circle me-1"></i>Nomor Induk Kependudukan sesuai KTP Anda
                        </small>
                        @error('nik')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nama Lengkap Input -->
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <i class="ti ti-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                            name="nama_lengkap" placeholder="Nama Lengkap Anda" 
                            value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email Input (Optional) -->
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <i class="ti ti-mail me-2"></i>Email <span class="text-muted">(Opsional)</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" placeholder="Email Anda (untuk notifikasi)" 
                            value="{{ old('email') }}">
                        <small class="text-muted d-block mt-1">
                            <i class="ti ti-info-circle me-1"></i>Gunakan untuk menerima notifikasi dan reset password
                        </small>
                        @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <i class="ti ti-lock me-2"></i>Kata Sandi <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" placeholder="Minimal 6 karakter" required>
                        <small class="text-muted d-block mt-1">
                            <i class="ti ti-info-circle me-1"></i>Gunakan kombinasi huruf, angka, dan simbol untuk keamanan
                        </small>
                        @error('password')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <i class="ti ti-lock me-2"></i>Konfirmasi Kata Sandi <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation" placeholder="Ulangi kata sandi Anda" required>
                        @error('password_confirmation')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Terms Agreement -->
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('agree_terms') is-invalid @enderror" 
                            type="checkbox" id="agreeTerms" name="agree_terms" value="on" required>
                        <label class="form-check-label" for="agreeTerms">
                            Saya setuju dengan <a href="#" class="link-primary">Syarat & Ketentuan</a> 
                            dan <a href="#" class="link-primary">Kebijakan Privasi</a>
                        </label>
                        @error('agree_terms')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg shadow">
                            <i class="ti ti-user-plus me-2"></i>Daftar Akun
                        </button>
                    </div>

                    <!-- Info Box -->
                    <div class="alert alert-light border mt-3" style="border-color: rgba(255,255,255,0.2) !important;">
                        <small>
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Info Penting:</strong> NIK yang Anda daftarkan harus sesuai dengan data di tabel penduduk desa. 
                            Jika belum terdaftar, silakan hubungi admin desa terlebih dahulu.
                        </small>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Sudah punya akun? 
                            <a href="/login" class="link-primary fw-bold">Login di sini</a>
                        </small>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection