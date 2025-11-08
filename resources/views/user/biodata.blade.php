@extends('layouts.dashboard')
@section('title', 'Isi Biodata')

@section('content')
<div class="pc-content">
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white rounded-top-4">
                <h4 class="mb-0">
                    <i class="bi bi-person-lines-fill me-2"></i> Formulir Biodata Warga
                </h4>
            </div>

            <div class="card-body p-4">
                <p class="text-muted mb-4">
                    Lengkapi data diri Anda sesuai dokumen kependudukan. Data ini digunakan untuk keperluan pelayanan dan administrasi di Sistem Informasi Desa.
                </p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('user.biodata.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div class="col-md-6">
                            <label for="nik" class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" maxlength="16" value="{{ old('nik') }}" placeholder="16 digit NIK" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Bandung" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="agama" class="form-label fw-semibold">Agama</label>
                            <select name="agama" id="agama" class="form-select" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                                <option>Konghucu</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="status_perkawinan" class="form-label fw-semibold">Status Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan" class="form-select" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option>Belum Kawin</option>
                                <option>Kawin</option>
                                <option>Cerai Hidup</option>
                                <option>Cerai Mati</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" placeholder="Contoh: Petani, Guru, Pegawai" required>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat lengkap Anda" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="no_hp" class="form-label fw-semibold">Nomor HP</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email ?? '') }}" readonly>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="reset" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-arrow-repeat me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Biodata
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
