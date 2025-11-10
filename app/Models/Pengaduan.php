<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'nomor_pengaduan',
        'jenis_surat',
        'judul_pengaduan',
        'isi_pengaduan',
        'bukti_lampiran',
        'status',
        'tanggapan_admin',
        'tanggal_tanggapan',
        'admin_id',
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    /**
     * Relasi ke User (pembuat pengaduan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Admin (yang menanggapi)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Generate nomor pengaduan otomatis
     */
    public static function generateNomorPengaduan()
    {
        $tahun = date('Y');
        $bulan = date('m');
        
        $lastPengaduan = self::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('id', 'desc')
            ->first();
        
        $urutan = $lastPengaduan ? intval(substr($lastPengaduan->nomor_pengaduan, -4)) + 1 : 1;
        
        return 'PGD/' . $tahun . '/' . $bulan . '/' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return [
            'pending' => 'warning',
            'diproses' => 'info',
            'selesai' => 'success',
            'ditolak' => 'danger',
        ][$this->status] ?? 'secondary';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ][$this->status] ?? 'Tidak Diketahui';
    }

    /**
     * Get jenis surat label
     */
    public function getJenisSuratLabelAttribute()
    {
        return [
            'surat_keterangan_domisili' => 'Surat Keterangan Domisili',
            'surat_keterangan_usaha' => 'Surat Keterangan Usaha',
            'surat_keterangan_tidak_mampu' => 'Surat Keterangan Tidak Mampu',
            'surat_pengantar_nikah' => 'Surat Pengantar Nikah',
            'surat_keterangan_kelahiran' => 'Surat Keterangan Kelahiran',
            'surat_keterangan_kematian' => 'Surat Keterangan Kematian',
            'lainnya' => 'Lainnya',
        ][$this->jenis_surat] ?? 'Tidak Diketahui';
    }
}