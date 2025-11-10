<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nomor_pengaduan')->unique();
            $table->enum('jenis_surat', [
                'surat_keterangan_domisili',
                'surat_keterangan_tidak_mampu',
                'surat_pengantar_nikah',
                'surat_keterangan_kelahiran',
                'surat_keterangan_kematian',
                'lainnya'
            ]);
            $table->string('judul_pengaduan');
            $table->text('isi_pengaduan');
            $table->string('bukti_lampiran')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('tanggapan_admin')->nullable();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};