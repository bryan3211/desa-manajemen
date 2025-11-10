@extends('layouts.dashboard')
@section('title', 'Edit Biodata')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.biodata.index') }}">Biodata</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Biodata</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="ti ti-alert-triangle me-2"></i>
                    <strong>Perhatian:</strong> Setelah Anda mengubah biodata, status verifikasi akan direset dan perlu diverifikasi ulang oleh admin.
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

                <form action="{{ route('user.biodata.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Same form fields as create, but with values -->
                    <!-- Data Pribadi -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Pribadi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik" value="{{ old('nik', $biodata->nik) }}" maxlength="16" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $biodata->nama_lengkap) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $biodata->tanggal_lahir->format('Y-m-d')) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select class="form-control" name="agama" required>
                                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                            <option value="{{ $agama }}" {{ old('agama', $biodata->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status_perkawinan" required>
                                        @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                            <option value="{{ $status }}" {{ old('status_perkawinan', $biodata->status_perkawinan) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan', $biodata->pekerjaan) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-control" name="pendidikan_terakhir">
                                        <option value="">-- Pilih --</option>
                                        @foreach(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'] as $pend)
                                            <option value="{{ $pend }}" {{ old('pendidikan_terakhir', $biodata->pendidikan_terakhir) == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                                        @endforeach
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
                                    <textarea class="form-control" name="alamat_lengkap" rows="3" required>{{ old('alamat_lengkap', $biodata->alamat_lengkap) }}</textarea>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rt" value="{{ old('rt', $biodata->rt) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rw" value="{{ old('rw', $biodata->rw) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="desa_kelurahan" value="{{ old('desa_kelurahan', $biodata->desa_kelurahan) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kecamatan" value="{{ old('kecamatan', $biodata->kecamatan) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kabupaten_kota" value="{{ old('kabupaten_kota', $biodata->kabupaten_kota) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="provinsi" value="{{ old('provinsi', $biodata->provinsi) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos', $biodata->kode_pos) }}" required>
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
                                    <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $biodata->no_hp) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $biodata->email) }}">
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
                                    <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah', $biodata->nama_ayah) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu', $biodata->nama_ibu) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu) }}">
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
                                    @if($biodata->foto_ktp)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/biodata/' . $biodata->foto_ktp) }}" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="foto_ktp" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto KK</label>
                                    @if($biodata->foto_kk)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/biodata/' . $biodata->foto_kk) }}" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="foto_kk" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Foto Diri</label>
                                    @if($biodata->foto_diri)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/biodata/' . $biodata->foto_diri) }}" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="foto_diri" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('user.biodata.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-2"></i>Update Biodata
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection