<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    public function run(): void
    {
        Penduduk::create([
            'nik' => '3515011234567890',
            'nama_lengkap' => 'Admin Test Desa',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '1990-05-15',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Raya Desa No. 123',
            'rt' => '01',
            'rw' => '02',
            'desa_kelurahan' => 'Desa Sukamaju',
            'kecamatan' => 'Kecamatan Gedangan',
            'kabupaten_kota' => 'Kabupaten Sidoarjo',
            'provinsi' => 'Jawa Timur',
            'kode_pos' => '61254',
            'no_hp' => '081234567890',
            'email' => 'admin@test.com',
            'status_perkawinan' => 'Kawin',
            'agama' => 'Islam',
            'pekerjaan' => 'Admin Desa',
            'pendidikan_terakhir' => 'S1',
            'status' => 'aktif',
            'created_by' => 1,
        ]);
    }
}