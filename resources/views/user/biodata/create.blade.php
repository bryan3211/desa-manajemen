@extends('layouts.dashboard')
@section('title', 'Isi Biodata')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Isi Biodata</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Isi Biodata</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="ti ti-info-circle me-2"></i>
                    <strong>Perhatian:</strong> Pastikan semua data yang Anda isi sesuai dengan dokumen resmi. Data yang
                    sudah diverifikasi tidak dapat diubah.
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.biodata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Data Pribadi -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik" value="{{ old('nik') }}"
                                        maxlength="16" required>
                                    <small class="text-muted">16 digit</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select class="form-control" name="agama" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status_perkawinan" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Belum Kawin"
                                            {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin
                                        </option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>
                                            Kawin</option>
                                        <option value="Cerai Hidup"
                                            {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup
                                        </option>
                                        <option value="Cerai Mati"
                                            {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pekerjaan"
                                        value="{{ old('pekerjaan') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-control" name="pendidikan_terakhir">
                                        <option value="">-- Pilih --</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
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
                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat_lengkap" rows="3" required>{{ old('alamat_lengkap') }}</textarea>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rt" value="{{ old('rt') }}"
                                        maxlength="3" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rw" value="{{ old('rw') }}"
                                        maxlength="3" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="desa_kelurahan"
                                        value="{{ old('desa_kelurahan') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kecamatan"
                                        value="{{ old('kecamatan') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kabupaten_kota"
                                        value="{{ old('kabupaten_kota') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="provinsi"
                                        value="{{ old('provinsi') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kode_pos"
                                        value="{{ old('kode_pos') }}" maxlength="5" required>
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
                                    <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
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
                                    <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_ayah"
                                        value="{{ old('nama_ayah') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="pekerjaan_ayah"
                                        value="{{ old('pekerjaan_ayah') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_ibu"
                                        value="{{ old('nama_ibu') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="pekerjaan_ibu"
                                        value="{{ old('pekerjaan_ibu') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Upload Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto KTP</label>
                                    <input type="file" class="form-control" name="foto_ktp" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto KK</label>
                                    <input type="file" class="form-control" name="foto_kk" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto Diri</label>
                                    <input type="file" class="form-control" name="foto_diri" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-2"></i>Simpan Biodata
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection