<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penduduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'kode_pos',
        'no_hp',
        'email',
        'status_perkawinan',
        'agama',
        'pekerjaan',
        'pendidikan_terakhir',
        'kewarganegaraan',
        'status',
        'foto',
        'catatan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    // Relasi ke User yang membuat
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke User yang update
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Accessor untuk umur
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        return [
            'aktif' => 'success',
            'tidak_aktif' => 'warning',
            'meninggal' => 'danger',
            'pindah' => 'info',
        ][$this->status] ?? 'secondary';
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        return [
            'aktif' => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
            'meninggal' => 'Meninggal',
            'pindah' => 'Pindah',
        ][$this->status] ?? 'Tidak Diketahui';
    }
}