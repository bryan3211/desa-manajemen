@extends('layouts.dashboard')
@section('title', 'Verifikasi Pengaduan')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pengaduan.index') }}">Kelola
                                    Pengaduan</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail & Verifikasi</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail & Verifikasi Pengaduan</h2>
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

                <!-- Detail Pengaduan -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $pengaduan->nomor_pengaduan }}</h5>
                            <span class="badge bg-{{ $pengaduan->status_badge }}">{{ $pengaduan->status_label }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <p class="text-muted mb-1">Nama Pengadu</p>
                                <p class="mb-0 fw-bold">{{ $pengaduan->user->name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1">Email</p>
                                <p class="mb-0 fw-bold">{{ $pengaduan->user->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <p class="text-muted mb-1">Jenis Surat</p>
                                <p class="mb-0 fw-bold">{{ $pengaduan->jenis_surat_label }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1">Tanggal Pengaduan</p>
                                <p class="mb-0 fw-bold">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="text-muted">Judul Pengaduan</h6>
                            <p class="mb-0 fs-5 fw-bold">{{ $pengaduan->judul_pengaduan }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Isi Pengaduan</h6>
                            <p class="mb-0">{!! nl2br(e($pengaduan->isi_pengaduan)) !!}</p>
                        </div>

                        @if ($pengaduan->bukti_lampiran)
                            <div class="mb-3">
                                <h6 class="text-muted">Bukti Lampiran</h6>
                                <a href="{{ asset('storage/pengaduan/' . $pengaduan->bukti_lampiran) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-download me-2"></i>Lihat Lampiran
                                </a>
                            </div>
                        @endif

                        @if ($pengaduan->tanggapan_admin)
                            <hr>
                            <div class="alert alert-light border">
                                <h6 class="alert-heading">
                                    <i class="ti ti-message-circle me-2"></i>Tanggapan Sebelumnya
                                </h6>
                                <p class="mb-2">{!! nl2br(e($pengaduan->tanggapan_admin)) !!}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-muted">
                                            <i class="ti ti-user me-1"></i>
                                            {{ $pengaduan->admin->name ?? 'Admin' }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <small class="text-muted">
                                            <i class="ti ti-clock me-1"></i>
                                            {{ $pengaduan->tanggal_tanggapan->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Form Tanggapan -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Tanggapan</h5>
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

                        <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>
                                        Menunggu</option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai</option>
                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>
                                        Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggapan Admin <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="tanggapan_admin" rows="6"
                                    placeholder="Tuliskan tanggapan Anda..." required>{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</textarea>
                                <small class="text-muted">Berikan tanggapan yang jelas dan detail</small>
                            </div>

                            <div class="alert alert-info">
                                <i class="ti ti-info-circle me-2"></i>
                                <small>Tanggapan akan dikirim ke email pengadu dan ditampilkan di dashboard
                                    mereka.</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-send me-2"></i>Kirim Tanggapan
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
                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                            <button type="button" class="btn btn-outline-info" onclick="window.print()">
                                <i class="ti ti-printer me-2"></i>Cetak Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection