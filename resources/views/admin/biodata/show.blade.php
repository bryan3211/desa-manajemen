@extends('layouts.dashboard')
@section('title', 'Detail & Verifikasi Biodata')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.biodata.index') }}">Kelola Biodata</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail & Verifikasi Biodata</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-lg-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Status Card -->
                <div class="card border-start border-4 border-{{ $biodata->status_badge }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-2">Status Verifikasi</h5>
                                <h3 class="mb-0">
                                    <span class="badge bg-{{ $biodata->status_badge }}">
                                        {{ $biodata->status_label }}
                                    </span>
                                </h3>
                                @if ($biodata->verified_at)
                                    <small class="text-muted">
                                        Diverifikasi oleh {{ $biodata->verifiedBy->name ?? 'Admin' }} pada {{ $biodata->verified_at->format('d M Y H:i') }}
                                    </small>
                                @endif
                            </div>
                            <div class="text-center">
                                <h4 class="mb-0">{{ $biodata->completion_percentage }}%</h4>
                                <small class="text-muted">Kelengkapan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Data Pribadi</h5>
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
                        <label class="text-muted mb-1">Alamat Lengkap</label>
                        <p class="fw-bold mb-0">{{ $biodata->alamat_lengkap_format }}</p>
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
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Email User</label>
                                <p class="fw-bold mb-0">{{ $biodata->user->email }}</p>
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
                                    <a href="{{ asset('storage/biodata/' . $biodata->foto_ktp) }}" target="_blank">
                                        <img src="{{ asset('storage/biodata/' . $biodata->foto_ktp) }}" alt="Foto KTP"
                                            class="img-fluid rounded border" style="max-height: 200px;">
                                    </a>
                                </div>
                            @endif
                            @if ($biodata->foto_kk)
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="text-muted mb-2 d-block">Foto KK</label>
                                    <a href="{{ asset('storage/biodata/' . $biodata->foto_kk) }}" target="_blank">
                                        <img src="{{ asset('storage/biodata/' . $biodata->foto_kk) }}" alt="Foto KK"
                                            class="img-fluid rounded border" style="max-height: 200px;">
                                    </a>
                                </div>
                            @endif
                            @if ($biodata->foto_diri)
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="text-muted mb-2 d-block">Foto Diri</label>
                                    <a href="{{ asset('storage/biodata/' . $biodata->foto_diri) }}" target="_blank">
                                        <img src="{{ asset('storage/biodata/' . $biodata->foto_diri) }}" alt="Foto Diri"
                                            class="img-fluid rounded border" style="max-height: 200px;">
                                    </a>
                                </div>
                            @endif
                            @if (!$biodata->foto_ktp && !$biodata->foto_kk && !$biodata->foto_diri)
                                <div class="col-12 text-center text-muted">
                                    <p>Belum ada dokumen</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Form Verifikasi -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.biodata.verify', $biodata->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Status Verifikasi <span class="text-danger">*</span></label>
                                <select class="form-control" name="status_verifikasi" required>
                                    <option value="sedang_diverifikasi" {{ $biodata->status_verifikasi == 'sedang_diverifikasi' ? 'selected' : '' }}>Sedang Diverifikasi</option>
                                    <option value="terverifikasi" {{ $biodata->status_verifikasi == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="ditolak" {{ $biodata->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Admin</label>
                                <textarea class="form-control" name="catatan_admin" rows="5" placeholder="Berikan catatan untuk warga...">{{ old('catatan_admin', $biodata->catatan_admin) }}</textarea>
                                <small class="text-muted">Catatan akan dilihat oleh warga</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-check me-2"></i>Simpan Verifikasi
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.biodata.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="button" class="btn btn-outline-info" onclick="window.print()">
                                <i class="ti ti-printer me-2"></i>Cetak Biodata
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection