@extends('layouts.dashboard')
@section('title', 'Biodata Saya')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Biodata</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Biodata Saya</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Status Card -->
                <div class="card border-start border-4 border-{{ $biodata->status_badge }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-2">Status Verifikasi Biodata</h5>
                                <h3 class="mb-0">
                                    <span class="badge bg-{{ $biodata->status_badge }}">
                                        {{ $biodata->status_label }}
                                    </span>
                                </h3>
                                @if ($biodata->catatan_admin)
                                    <div class="mt-3 alert alert-light border">
                                        <strong>Catatan Admin:</strong>
                                        <p class="mb-0 mt-2">{{ $biodata->catatan_admin }}</p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="text-center">
                                    <h4 class="mb-0">{{ $biodata->completion_percentage }}%</h4>
                                    <small class="text-muted">Kelengkapan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Data Pribadi</h5>
                            @if ($biodata->status_verifikasi !== 'terverifikasi')
                                <a href="{{ route('user.biodata.edit') }}" class="btn btn-sm btn-primary">
                                    <i class="ti ti-edit me-2"></i>Edit Biodata
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">NIK</label>
                                <p class="fw-bold mb-0">{{ $biodata->nik }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Nama Lengkap</label>
                                <p class="fw-bold mb-0">{{ $biodata->nama_lengkap }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Tempat Lahir</label>
                                <p class="fw-bold mb-0">{{ $biodata->tempat_lahir }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Tanggal Lahir</label>
                                <p class="fw-bold mb-0">{{ $biodata->tanggal_lahir->format('d M Y') }} ({{ $biodata->umur }} tahun)</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Jenis Kelamin</label>
                                <p class="fw-bold mb-0">{{ $biodata->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Agama</label>
                                <p class="fw-bold mb-0">{{ $biodata->agama }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Status Perkawinan</label>
                                <p class="fw-bold mb-0">{{ $biodata->status_perkawinan }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-muted mb-1">Pekerjaan</label>
                                <p class="fw-bold mb-0">{{ $biodata->pekerjaan }}</p>
                            </div>
                            @if ($biodata->pendidikan_terakhir)
                                <div class="col-md-12 mb-3">
                                    <label class="text-muted mb-1">Pendidikan Terakhir</label>
                                    <p class="fw-bold mb-0">{{ $biodata->pendidikan_terakhir }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="text-muted mb-1">Alamat Lengkap</label>
                                <p class="fw-bold mb-0">{{ $biodata->alamat_lengkap_format }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Kontak</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">No. HP</label>
                                <p class="fw-bold mb-0">{{ $biodata->no_hp }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Email</label>
                                <p class="fw-bold mb-0">{{ $biodata->email ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Data Keluarga</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Nama Ayah</label>
                                <p class="fw-bold mb-0">{{ $biodata->nama_ayah }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Pekerjaan Ayah</label>
                                <p class="fw-bold mb-0">{{ $biodata->pekerjaan_ayah ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Nama Ibu</label>
                                <p class="fw-bold mb-0">{{ $biodata->nama_ibu }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Pekerjaan Ibu</label>
                                <p class="fw-bold mb-0">{{ $biodata->pekerjaan_ibu ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Dokumen</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($biodata->foto_ktp)
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="text-muted mb-2 d-block">Foto KTP</label>
                                    <img src="{{ asset('storage/biodata/' . $biodata->foto_ktp) }}" alt="Foto KTP"
                                        class="img-fluid rounded border" style="max-height: 200px;">
                                </div>
                            @endif
                            @if ($biodata->foto_kk)
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="text-muted mb-2 d-block">Foto KK</label>
                                    <img src="{{ asset('storage/biodata/' . $biodata->foto_kk) }}" alt="Foto KK"
                                        class="img-fluid rounded border" style="max-height: 200px;">
                                </div>
                            @endif
                            @if ($biodata->foto_diri)
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="text-muted mb-2 d-block">Foto Diri</label>
                                    <img src="{{ asset('storage/biodata/' . $biodata->foto_diri) }}" alt="Foto Diri"
                                        class="img-fluid rounded border" style="max-height: 200px;">
                                </div>
                            @endif
                            @if (!$biodata->foto_ktp && !$biodata->foto_kk && !$biodata->foto_diri)
                                <div class="col-12 text-center text-muted">
                                    <p>Belum ada dokumen yang diupload</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection