@extends('layouts.dashboard')

@section('title', 'Dashboard - Sistem Informasi Desa')

@section('content')
<div class="pc-content" style="background: #f8fdfc;">
    <!-- [ Header Dashboard ] -->
    <div class="rounded-4 shadow-sm p-4 mb-4"
        style="background: linear-gradient(135deg, #1abc9c, #16a085); color: #fff;">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang di Sistem Informasi Desa</h4>
                <p class="mb-0 opacity-75">Halo, <strong>{{ auth()->user()->name }}</strong>! Semoga harimu menyenangkan </p>
            </div>
            <span class="badge bg-light text-success px-3 py-2 shadow-sm text-uppercase">
                {{ auth()->user()->role }}
            </span>
        </div>
    </div>

    <!-- [ Statistik Utama ] -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 text-center py-4" style="background:#ffffff;">
                <div class="text-toska mb-2">
                    <i class="ti ti-users fs-2"></i>
                </div>
                <h6 class="fw-bold text-secondary mb-1">Jumlah Penduduk</h6>
                <h2 class="fw-bolder text-toska">1.248</h2>
                <small class="text-muted">Warga aktif</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 text-center py-4" style="background:#ffffff;">
                <div class="text-toska mb-2">
                    <i class="ti ti-file-text fs-2"></i>
                </div>
                <h6 class="fw-bold text-secondary mb-1">Layanan Surat</h6>
                <h2 class="fw-bolder text-toska">327</h2>
                <small class="text-muted">Surat diproses</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 text-center py-4" style="background:#ffffff;">
                <div class="text-toska mb-2">
                    <i class="ti ti-wallet fs-2"></i>
                </div>
                <h6 class="fw-bold text-secondary mb-1">Dana Desa</h6>
                <h2 class="fw-bolder text-toska">Rp 452 Jt</h2>
                <small class="text-muted">Terserap 2025</small>
            </div>
        </div>
    </div>

    <!-- [ Konten Berdasarkan Role ] -->
    @if (auth()->user()->role == 'admin')
        @include('admin.dashboard')
    @else
        @include('user.dashboard')
    @endif

    <!-- [ Statistik Grafik dan Informasi ] -->
    <div class="row g-4 mt-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="fw-semibold text-toska mb-0">Grafik Pelayanan Desa</h5>
                    <small class="text-muted">Data Tahun 2025</small>
                </div>
                <div class="card-body">
                    <canvas id="desaChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="fw-semibold text-toska mb-0">Informasi Terkini</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item border-0"> Pembuatan e-KTP dibuka kembali.</li>
                        <li class="list-group-item border-0"> Penyaluran BLT tahap III minggu depan.</li>
                        <li class="list-group-item border-0"> Pemeliharaan sistem 15 Oktober.</li>
                        <li class="list-group-item border-0"> Laporan Dana Desa Q3 telah tersedia.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- [ Custom Styles Inline ] -->
<style>
    .text-toska {
        color: #1abc9c !important;
    }
    .card {
        transition: 0.3s all ease-in-out;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(26, 188, 156, 0.1);
    }
</style>

<!-- [ Chart JS Script ] -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('desaChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Layanan Surat',
                data: [42, 65, 58, 72, 80, 95],
                borderColor: '#1abc9c',
                backgroundColor: 'rgba(26, 188, 156, 0.2)',
                tension: 0.4,
                fill: true,
                pointRadius: 4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
@endsection
