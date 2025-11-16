@extends('layouts.dashboard')
@section('title', 'Detail Penduduk')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.penduduk.index') }}">Data Penduduk</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $penduduk->nama_lengkap }}</h5>
                            <span class="badge bg-{{ $penduduk->status_badge }}">{{ $penduduk->status_label }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">NIK</p>
                                <p class="fw-bold mb-3">{{ $penduduk->nik }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Agama</p>
                                <p class="fw-bold mb-3">{{ $penduduk->agama }}</p>
                            </div>
                        </div>

                        <h6 class="mt-4 mb-3 fw-bold">Kelahiran</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tempat Lahir</p>
                                <p class="mb-3">{{ $penduduk->tempat_lahir }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal Lahir</p>
                                <p class="mb-3">{{ $penduduk->tanggal_lahir->format('d F Y') }} (Umur: {{ $penduduk->umur }} tahun)</p>
                            </div>
                        </div>

                        <h6 class="mt-4 mb-3 fw-bold">Alamat</h6>
                        <p>{{ $penduduk->alamat }}, RT {{ $penduduk->rt }}/RW {{ $penduduk->rw }}</p>
                        <p>{{ $penduduk->desa_kelurahan }}, {{ $penduduk->kecamatan }}<br>
                           {{ $penduduk->kabupaten_kota }}, {{ $penduduk->provinsi }} {{ $penduduk->kode_pos }}</p>

                        <h6 class="mt-4 mb-3 fw-bold">Kontak</h6>
                        <p>Telepon: {{ $penduduk->no_hp ?? '-' }}<br>
                           Email: {{ $penduduk->email ?? '-' }}</p>

                        <h6 class="mt-4 mb-3 fw-bold">Pekerjaan & Pendidikan</h6>
                        <p>Pekerjaan: {{ $penduduk->pekerjaan ?? '-' }}<br>
                           Pendidikan: {{ $penduduk->pendidikan_terakhir ?? '-' }}</p>

                        @if ($penduduk->catatan)
                            <h6 class="mt-4 mb-3 fw-bold">Catatan</h6>
                            <p>{{ $penduduk->catatan }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Foto -->
                <div class="card mb-3">
                    <div class="card-body text-center">
                        @if ($penduduk->foto)
                            <img src="{{ asset('storage/penduduk/' . $penduduk->foto) }}" 
                                class="img-fluid rounded mb-3" style="max-width: 200px;">
                        @else
                            <div class="bg-light rounded p-5 mb-3">
                                <i class="ti ti-photo f-40 text-muted"></i>
                                <p class="text-muted mt-2">Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" class="btn btn-warning w-100 mb-2">
                            <i class="ti ti-pencil me-2"></i>Edit Data
                        </a>
                        <form action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 mb-2">
                                <i class="ti ti-trash me-2"></i>Hapus Data
                            </button>
                        </form>
                        <a href="{{ route('admin.penduduk.index') }}" class="btn btn-secondary w-100">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection