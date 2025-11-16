@extends('layouts.auth')

@section('title', 'Login - Desa Digital')

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
        max-width: 420px;
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

    .link-primary, .text-secondary {
        color: #1abc9c !important;
    }

    .link-primary:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .saprator {
        text-align: center;
        margin: 1rem 0;
        position: relative;
    }

    .saprator span {
        background: rgba(0, 0, 0, 0.4);
        padding: 0 10px;
        color: #ccc;
    }

    .saprator::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 1px;
        top: 50%;
        left: 0;
        background: rgba(255, 255, 255, 0.2);
        z-index: -1;
    }
</style>

<div class="container">
    <div class="card my-5 p-4">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Masuk Sistem</b></h3>
                    <a href="/register" class="link-primary small">Belum punya akun?</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div><i class="ti ti-alert-circle me-2"></i>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="ti ti-check me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <!-- NIK Input -->
                <div class="form-group mb-3">
                    <label class="form-label">
                        <i class="ti ti-id-badge me-2"></i>NIK (16 Digit)
                    </label>
                    <input type="text" class="form-control" name="nik" 
                        placeholder="Contoh: 3515011234567890" maxlength="16" 
                        pattern="[0-9]{16}" value="{{ session('registered_email') }}" 
                        autocomplete="off" required>
                    <small class="text-muted d-block mt-1">
                        Masukkan 16 digit Nomor Induk Kependudukan Anda
                    </small>
                </div>

                <!-- Password Input -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">
                        <i class="ti ti-lock me-2"></i>Kata Sandi
                    </label>
                    <input id="password" type="password" class="form-control" 
                        name="password" placeholder="Password"
                        @if (session('registered_email')) autofocus @endif required>
                </div>

                <!-- Remember & Forgot -->
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                            id="customCheckc1" name="remember">
                        <label class="form-check-label text-light" for="customCheckc1">
                            <i class="ti ti-bookmark me-1"></i>Ingat saya
                        </label>
                    </div>
                    <a href="{{ route('forgot_password.email_form') }}" class="text-secondary">
                        <i class="ti ti-help me-1"></i>Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg shadow">
                        <i class="ti ti-login me-2"></i>Login
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Belum terdaftar? 
                        <a href="/register" class="link-primary fw-bold">Daftar di sini</a>
                    </small>
                </div>

                <div class="saprator mt-4">
                    <span>atau masuk dengan</span>
                </div>

                @include('auth.sso')
            </div>
        </form>
    </div>
</div>
@endsection