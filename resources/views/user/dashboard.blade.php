<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h2 class="mb-3 text-success">
                    Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>!
                </h2>

                {{-- Pesan verifikasi email --}}
                @if (!$user->is_verified)
                    <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Email Anda belum terverifikasi.</strong> 
                                Silakan verifikasi terlebih dahulu untuk mengakses fitur Sistem Informasi Desa.
                            </div>
                        </div>

                        <a href="{{ route('verify.form') }}" id="verify-button"
                            class="btn btn-warning btn-sm fw-bold">Verifikasi Sekarang</a>
                    </div>
                @endif

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Deskripsi utama --}}
                <p class="lead mb-4">
                    Ini adalah <span class="fw-bold text-success">Dashboard</span> Anda pada 
                    <span class="text-primary">Sistem Informasi Desa Digital</span>.
                    Gunakan menu di bawah untuk mengakses berbagai layanan dan data penting desa Anda.
                </p>

                {{-- 3 Kartu Fitur Utama --}}
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-success h-100 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-people-fill fs-2 text-success"></i>
                                <h5 class="card-title mt-2">Data Penduduk</h5>
                                <p class="card-text text-muted">Kelola data warga desa dengan mudah dan akurat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card border-info h-100 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-envelope-paper-fill fs-2 text-info"></i>
                                <h5 class="card-title mt-2">Pelayanan Desa</h5>
                                <p class="card-text text-muted">Ajukan berbagai surat keterangan secara daring.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card border-warning h-100 shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-bar-chart-line-fill fs-2 text-warning"></i>
                                <h5 class="card-title mt-2">Informasi Desa</h5>
                                <p class="card-text text-muted">Lihat pengumuman, berita, dan kegiatan terbaru desa.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Profil --}}
                <a href="/myprofile" class="btn btn-success mt-4 px-4 fw-bold shadow-sm">
                    <i class="bi bi-person-circle me-2"></i>Lihat Profil Saya
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Script tombol verifikasi loading saat diklik
    const verifyButton = document.getElementById('verify-button');
    if (verifyButton) {
        verifyButton.addEventListener('click', function() {
            this.classList.add('disabled');
            this.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Memproses...
            `;
        });
    }
</script>
