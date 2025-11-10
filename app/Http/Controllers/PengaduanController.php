<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of pengaduan for user
     */
    public function index()
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new pengaduan
     */
    public function create()
    {
        return view('user.pengaduan.create');
    }

    /**
     * Store a newly created pengaduan
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:surat_keterangan_domisili,surat_keterangan_usaha,surat_keterangan_tidak_mampu,surat_pengantar_nikah,surat_keterangan_kelahiran,surat_keterangan_kematian,lainnya',
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'bukti_lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'judul_pengaduan.required' => 'Judul pengaduan harus diisi',
            'isi_pengaduan.required' => 'Isi pengaduan harus diisi',
            'bukti_lampiran.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
            'bukti_lampiran.max' => 'Ukuran file maksimal 2MB',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'nomor_pengaduan' => Pengaduan::generateNomorPengaduan(),
            'jenis_surat' => $request->jenis_surat,
            'judul_pengaduan' => $request->judul_pengaduan,
            'isi_pengaduan' => $request->isi_pengaduan,
            'status' => 'pending',
        ];

        // Handle file upload
        if ($request->hasFile('bukti_lampiran')) {
            $file = $request->file('bukti_lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pengaduan', $fileName, 'public');
            $data['bukti_lampiran'] = $fileName;
        }

        Pengaduan::create($data);

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diajukan. Nomor pengaduan: ' . $data['nomor_pengaduan']);
    }

    /**
     * Display the specified pengaduan
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Remove the specified pengaduan
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        // Delete file if exists
        if ($pengaduan->bukti_lampiran) {
            Storage::disk('public')->delete('pengaduan/' . $pengaduan->bukti_lampiran);
        }

        $pengaduan->delete();

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    // ========== ADMIN METHODS ==========

    /**
     * Display a listing of all pengaduan for admin
     */
    public function adminIndex()
    {
        $pengaduan = Pengaduan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $statistik = [
            'pending' => Pengaduan::where('status', 'pending')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'ditolak' => Pengaduan::where('status', 'ditolak')->count(),
        ];

        return view('admin.pengaduan.index', compact('pengaduan', 'statistik'));
    }

    /**
     * Show detail pengaduan for admin
     */
    public function adminShow($id)
    {
        $pengaduan = Pengaduan::with(['user', 'admin'])->findOrFail($id);

        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update status and tanggapan pengaduan
     */
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'tanggapan_admin' => 'required|string',
        ], [
            'status.required' => 'Status harus dipilih',
            'tanggapan_admin.required' => 'Tanggapan admin harus diisi',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
            'tanggal_tanggapan' => now(),
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Tanggapan berhasil disimpan');
    }

    /**
     * Filter pengaduan by status
     */
    public function adminFilter(Request $request)
    {
        $query = Pengaduan::with('user')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('jenis_surat') && $request->jenis_surat != 'all') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        $pengaduan = $query->paginate(15);

        $statistik = [
            'pending' => Pengaduan::where('status', 'pending')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'ditolak' => Pengaduan::where('status', 'ditolak')->count(),
        ];

        return view('admin.pengaduan.index', compact('pengaduan', 'statistik'));
    }
}