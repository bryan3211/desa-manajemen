@extends('layouts.dashboard')
@section('title', 'Data Penduduk')
@section('content')
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Data Penduduk</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Data Penduduk Desa</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-users f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Total</h6>
                                <h4 class="mb-0">{{ $statistik['total'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-success">
                                    <i class="ti ti-user-check f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Aktif</h6>
                                <h4 class="mb-0">{{ $statistik['aktif'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-warning">
                                    <i class="ti ti-user-off f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Tidak Aktif</h6>
                                <h4 class="mb-0">{{ $statistik['tidak_aktif'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-danger">
                                    <i class="ti ti-cross f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Meninggal</h6>
                                <h4 class="mb-0">{{ $statistik['meninggal'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-info">
                                    <i class="ti ti-arrow-right f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Pindah</h6>
                                <h4 class="mb-0">{{ $statistik['pindah'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary btn-sm w-100">
                            <i class="ti ti-plus"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Table -->
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
                        <h5 class="mb-0">Daftar Penduduk</h5>
                    </div>
                    <div class="card-body">
                        <!-- Filter -->
                        <form action="{{ route('admin.penduduk.index') }}" method="GET" class="mb-3">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" 
                                        placeholder="Cari NIK atau Nama..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="status">
                                        <option value="all">Semua Status</option>
                                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="meninggal" {{ request('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                        <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tempat, Tgl Lahir</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penduduk as $item)
                                        <tr>
                                            <td><strong>{{ $item->nik }}</strong></td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>
                                                <small>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir->format('d M Y') }}</small>
                                                <br>
                                                <small class="text-muted">Umur: {{ $item->umur }} tahun</small>
                                            </td>
                                            <td>{{ Str::limit($item->alamat, 30) }}</td>
                                            <td>{{ $item->no_hp ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->status_badge }}">
                                                    {{ $item->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.penduduk.show', $item->id) }}" 
                                                    class="btn btn-sm btn-icon btn-light-primary">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.penduduk.edit', $item->id) }}" 
                                                    class="btn btn-sm btn-icon btn-light-warning">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.penduduk.destroy', $item->id) }}" method="POST" 
                                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-light-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <i class="ti ti-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                                <p class="text-muted mt-2">Tidak ada data penduduk</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $penduduk->links() }}
                        </div>

                        <!-- Export Button -->
                        <div class="mt-3">
                            <a href="{{ route('admin.penduduk.export') }}" class="btn btn-success">
                                <i class="ti ti-download me-2"></i>Export CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection