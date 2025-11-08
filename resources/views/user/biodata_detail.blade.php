@extends('layouts.app')

@section('title', 'Detail Biodata')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Biodata</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $biodata->nama }}</td></tr>
        <tr><th>NIK</th><td>{{ $biodata->nik }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $biodata->tempat_lahir }}, {{ $biodata->tanggal_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ ucfirst($biodata->jenis_kelamin) }}</td></tr>
        <tr><th>Agama</th><td>{{ $biodata->agama }}</td></tr>
        <tr><th>Status Perkawinan</th><td>{{ $biodata->status_perkawinan }}</td></tr>
        <tr><th>Pekerjaan</th><td>{{ $biodata->pekerjaan }}</td></tr>
        <tr><th>Alamat</th><td>{{ $biodata->alamat }}</td></tr>
        <tr><th>No HP</th><td>{{ $biodata->no_hp }}</td></tr>
        <tr><th>Email</th><td>{{ $biodata->email }}</td></tr>
    </table>

    <a href="{{ route('user.biodata') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
