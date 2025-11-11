@extends('layouts.landing')

@section('title', 'Selamat Datang di Sistem Informasi Desa')

@section('content')
<!-- [ Hero Section ] -->
<header id="home" class="d-flex align-items-center position-relative"
    style="min-height: 100dvh; background: linear-gradient(to bottom, rgba(15, 75, 15, 0.7), rgba(0, 0, 0, 0.3)), url('{{ asset('assets/images/my/desa-sid.png') }}') center/cover no-repeat;">
    <div class="container text-center text-white py-5">
        <h1 class="fw-bold display-4 mb-3 animate__animated animate__fadeInDown">
            Sistem Informasi <span class="text-warning">Desa Digital</span>
        </h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp">
            Transformasi digital untuk meningkatkan pelayanan publik dan transparansi pemerintahan desa.
        </p>
        <div class="mt-4 animate__animated animate__fadeInUp animate__delay-1s">
            <a href="{{ route('login') }}" class="btn btn-green btn-lg shadow-sm me-2">Masuk Sistem</a>
            <a href="#fitur" class="btn btn-outline-light btn-lg">Jelajahi Fitur</a>
        </div>
    </div>
</header>

<!-- [ Fitur Utama ] -->
<section id="fitur" class="py-5 bg-light">
    <div class="container text-center mb-5">
        <h5 class="text-success">Layanan Desa Modern</h5>
        <h2 class="fw-bold mb-3">Fitur Utama</h2>
        <p class="text-muted">Mendukung administrasi dan pelayanan publik berbasis digital untuk desa yang lebih maju.</p>
    </div>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 hover-shadow">
                    <img src="{{ asset('assets/images/landing/data.penduduk.jpg') }}" class="img-fluid rounded-3 mb-3" alt="Data Penduduk">
                    <h5 class="fw-semibold text-success">Data Penduduk</h5>
                    <p class="text-muted mb-0">Kelola data warga dengan sistem yang terintegrasi dan mudah diakses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 hover-shadow">
                    <img src="{{ asset('assets/images/landing/pelayanan-online.jpg') }}" class="img-fluid rounded-3 mb-3" alt="Pelayanan Online">
                    <h5 class="fw-semibold text-success">Pelayanan Online</h5>
                    <p class="text-muted mb-0">Ajukan berbagai surat desa secara daring tanpa harus datang ke kantor desa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 hover-shadow">
                    <img src="{{ asset('assets/images/landing/keuangan.svg') }}" class="img-fluid rounded-3 mb-3" alt="Transparansi Keuangan">
                    <h5 class="fw-semibold text-success">Transparansi Keuangan</h5>
                    <p class="text-muted mb-0">Pantau anggaran desa secara terbuka dan akuntabel untuk masyarakat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [ Alur Sistem ] -->
<section id="alur" class="py-5 bg-white">
    <div class="container text-center mb-5">
        <h5 class="text-success">Langkah Mudah</h5>
        <h2 class="fw-bold mb-3">Cara Menggunakan Sistem</h2>
        <p class="text-muted">Empat langkah cepat untuk memanfaatkan layanan desa digital.</p>
    </div>

    <div class="container">
        <div class="row g-4 justify-content-center">
            @php
                $steps = [
                    ['icon' => 'ti ti-user-check', 'title' => 'Login', 'desc' => 'Masuk menggunakan akun perangkat desa atau warga.'],
                    ['icon' => 'ti ti-file-text', 'title' => 'Isi Data', 'desc' => 'Lengkapi data sesuai kebutuhan layanan.'],
                    ['icon' => 'ti ti-shield-check', 'title' => 'Verifikasi', 'desc' => 'Data diverifikasi oleh perangkat desa.'],
                    ['icon' => 'ti ti-mail', 'title' => 'Selesai', 'desc' => 'Surat atau hasil layanan dapat diunduh langsung.']
                ];
            @endphp
            @foreach ($steps as $index => $step)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 text-center py-4 hover-shadow h-100">
                        <i class="{{ $step['icon'] }} fs-1 text-success mb-3"></i>
                        <h5 class="fw-bold mb-2">{{ $loop->iteration }}. {{ $step['title'] }}</h5>
                        <p class="text-muted">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- [ CTA Section ] -->
<section class="position-relative text-center text-white"
    style="padding:100px 0; background:url('{{ asset('assets/images/my/bg-desa.png') }}') center/cover fixed;">
    <div class="overlay position-absolute top-0 bottom-0 start-0 end-0 bg-dark opacity-75"></div>
    <div class="container position-relative">
        <h2 class="fw-bold mb-3">Siap Menjadi Desa <span class="text-warning">Digital dan Transparan</span>?</h2>
        <p class="lead mb-4">Bangun tata kelola desa yang efektif dan melibatkan warga secara aktif.</p>
        <a href="{{ route('login') }}" class="btn btn-green btn-lg shadow-lg">Mulai Sekarang</a>
    </div>
</section>

<!-- [ Statistik ] -->
<section class="py-5 bg-light">
    <div class="container text-center mb-5">
        <h5 class="text-success">Data Statistik</h5>
        <h2 class="fw-bold mb-3">Perkembangan Desa Digital</h2>
    </div>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card p-4 rounded-4 bg-white shadow-sm">
                    <h2 class="text-success fw-bold">20+</h2>
                    <h5 class="fw-semibold">Desa Aktif</h5>
                    <p class="text-muted mb-0">Telah bergabung dalam sistem digitalisasi desa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 rounded-4 bg-white shadow-sm">
                    <h2 class="text-success fw-bold">2.500+</h2>
                    <h5 class="fw-semibold">Data Penduduk</h5>
                    <p class="text-muted mb-0">Tersimpan aman dan mudah diakses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 rounded-4 bg-white shadow-sm">
                    <h2 class="text-success fw-bold">98%</h2>
                    <h5 class="fw-semibold">Kepuasan Pengguna</h5>
                    <p class="text-muted mb-0">Warga dan perangkat merasa terbantu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [ Testimoni ] -->
<section class="py-5">
    <div class="container text-center mb-5">
        <h5 class="text-success">Testimoni</h5>
        <h2 class="fw-bold mb-3">Pendapat Pengguna</h2>
        <p class="text-muted">Cerita sukses dari desa yang telah bertransformasi digital.</p>
    </div>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-3 h-100">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('assets/images/user/khofifi.jpg') }}" class="wid-50 rounded-circle me-3">
                        <div>
                            <h5 class="mb-1 fw-semibold">Khofifi Anhar</h5>
                            <small class="text-muted d-block mb-2">Kepala Desa Sukamaju</small>
                            <p class="text-muted">“Pelayanan jadi cepat dan data bisa dicek kapan pun. Warga senang, kerja lebih efisien.”</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-3 h-100">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" class="wid-50 rounded-circle me-3">
                        <div>
                            <h5 class="mb-1 fw-semibold">Rina Kartika</h5>
                            <small class="text-muted d-block mb-2">Sekretaris Desa Mekarsari</small>
                            <p class="text-muted">“Laporan keuangan dan administrasi bisa langsung diakses oleh kepala desa.”</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-3 h-100">
                    <div class="d-flex align-items-start">
                        <img src="{{ asset('assets/images/user/avatar-3.jpg') }}" class="wid-50 rounded-circle me-3">
                        <div>
                            <h5 class="mb-1 fw-semibold">Siti Rahma</h5>
                            <small class="text-muted d-block mb-2">Warga Desa Cempaka</small>
                            <p class="text-muted">“Cuma lewat HP, saya bisa ajukan surat domisili tanpa antre di kantor desa.”</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .stat-card:hover { background: #ecfdf5; transition: 0.3s ease; }
</style>
@endsection
