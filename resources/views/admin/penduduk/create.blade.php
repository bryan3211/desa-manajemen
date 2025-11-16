@extends('layouts.dashboard')
@section('title', 'Tambah Data Penduduk')
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
                            <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Tambah Data Penduduk</h5>
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

                        <form action="{{ route('admin.penduduk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Bagian 1: Data Diri -->
                            <h6 class="mb-3 mt-4 fw-bold text-primary">1. Data Diri</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik" maxlength="16" 
                                        pattern="[0-9]{16}" placeholder="Contoh: 3515011234567890"
                                        value="{{ old('nik') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" 
                                        value="{{ old('nama_lengkap') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" 
                                        value="{{ old('tempat_lahir') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" 
                                        value="{{ old('tanggal_lahir') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select class="form-control" name="agama" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian 2: Alamat -->
                            <h6 class="mb-3 mt-4 fw-bold text-primary">2. Alamat</h6>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rt" maxlength="3" 
                                        pattern="[0-9]+" value="{{ old('rt') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rw" maxlength="3" 
                                        pattern="[0-9]+" value="{{ old('rw') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="desa_kelurahan" 
                                        value="{{ old('desa_kelurahan') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kecamatan" 
                                        value="{{ old('kecamatan') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kabupaten_kota" 
                                        value="{{ old('kabupaten_kota') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="provinsi" 
                                        value="{{ old('provinsi') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kode_pos" maxlength="5" 
                                        pattern="[0-9]{5}" value="{{ old('kode_pos') }}" required>
                                </div>
                            </div>

                            <!-- Bagian 3: Kontak & Status -->
                            <h6 class="mb-3 mt-4 fw-bold text-primary">3. Kontak & Status</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" class="form-control" name="no_hp" maxlength="15" 
                                        pattern="[0-9]+" value="{{ old('no_hp') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status_perkawinan" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="meninggal" {{ old('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                        <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian 4: Pekerjaan & Pendidikan -->
                            <h6 class="mb-3 mt-4 fw-bold text-primary">4. Pekerjaan & Pendidikan</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-control" name="pendidikan_terakhir">
                                        <option value="">-- Pilih --</option>
                                        <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bagian 5: File & Catatan -->
                            <h6 class="mb-3 mt-4 fw-bold text-primary">5. File & Catatan</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Foto</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                    <small class="text-muted">Max 2MB (JPG, PNG)</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="mt-4">
                                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection