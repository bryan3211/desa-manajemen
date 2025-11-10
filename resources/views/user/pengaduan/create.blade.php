@extends('layouts.dashboard')
@section('title', 'Ajukan Pengaduan Surat')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.pengaduan.index') }}">Pengaduan Surat</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Ajukan Pengaduan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Ajukan Pengaduan Surat</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Pengaduan Surat</h5>
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

                        <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select class="form-control" name="jenis_surat" required>
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    <option value="surat_keterangan_domisili">Surat Keterangan Domisili</option>
                                    <option value="surat_keterangan_usaha">Surat Keterangan Usaha</option>
                                    <option value="surat_keterangan_tidak_mampu">Surat Keterangan Tidak Mampu</option>
                                    <option value="surat_pengantar_nikah">Surat Pengantar Nikah</option>
                                    <option value="surat_keterangan_kelahiran">Surat Keterangan Kelahiran</option>
                                    <option value="surat_keterangan_kematian">Surat Keterangan Kematian</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="judul_pengaduan"
                                    placeholder="Contoh: Kesalahan data pada surat domisili" value="{{ old('judul_pengaduan') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi Pengaduan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="isi_pengaduan" rows="5"
                                    placeholder="Jelaskan pengaduan Anda secara detail..." required>{{ old('isi_pengaduan') }}</textarea>
                                <small class="text-muted">Jelaskan masalah yang Anda alami dengan jelas dan detail</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Lampiran (Opsional)</label>
                                <input type="file" class="form-control" name="bukti_lampiran" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maksimal 2MB</small>
                            </div>

                            <div class="alert alert-info">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Informasi:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Pengaduan akan diproses maksimal 3x24 jam kerja</li>
                                    <li>Anda akan mendapat notifikasi jika ada tanggapan dari admin</li>
                                    <li>Pastikan informasi yang Anda berikan akurat dan lengkap</li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('user.pengaduan.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-send me-2"></i>Kirim Pengaduan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection