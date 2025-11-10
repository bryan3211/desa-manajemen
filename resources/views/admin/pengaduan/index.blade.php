@extends('layouts.dashboard')
@section('title', 'Kelola Pengaduan Surat')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Kelola Pengaduan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Kelola Pengaduan Surat</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-warning">
                                    <i class="ti ti-clock f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Menunggu</h6>
                                <h4 class="mb-0">{{ $statistik['pending'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-info">
                                    <i class="ti ti-refresh f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Diproses</h6>
                                <h4 class="mb-0">{{ $statistik['diproses'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-success">
                                    <i class="ti ti-check f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Selesai</h6>
                                <h4 class="mb-0">{{ $statistik['selesai'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-danger">
                                    <i class="ti ti-x f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Ditolak</h6>
                                <h4 class="mb-0">{{ $statistik['ditolak'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Table -->
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Pengaduan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Filter -->
                        <form action="{{ route('admin.pengaduan.filter') }}" method="GET" class="mb-3">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-control" name="status">
                                        <option value="all">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Menunggu
                                        </option>
                                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="jenis_surat">
                                        <option value="all">Semua Jenis Surat</option>
                                        <option value="surat_keterangan_domisili">Surat Keterangan Domisili</option>
                                        <option value="surat_keterangan_usaha">Surat Keterangan Usaha</option>
                                        <option value="surat_keterangan_tidak_mampu">Surat Keterangan Tidak Mampu
                                        </option>
                                        <option value="surat_pengantar_nikah">Surat Pengantar Nikah</option>
                                        <option value="surat_keterangan_kelahiran">Surat Keterangan Kelahiran</option>
                                        <option value="surat_keterangan_kematian">Surat Keterangan Kematian</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ti ti-filter me-2"></i>Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Pengaduan</th>
                                        <th>Nama Pengadu</th>
                                        <th>Jenis Surat</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengaduan as $item)
                                        <tr>
                                            <td><strong>{{ $item->nomor_pengaduan }}</strong></td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->jenis_surat_label }}</td>
                                            <td>{{ Str::limit($item->judul_pengaduan, 40) }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->status_badge }}">
                                                    {{ $item->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.pengaduan.show', $item->id) }}"
                                                    class="btn btn-sm btn-icon btn-light-primary">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <i class="ti ti-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                                <p class="text-muted mt-2">Tidak ada data pengaduan</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $pengaduan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection