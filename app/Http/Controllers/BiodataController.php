<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    /**
     * Show biodata form or display if exists
     */
    public function index()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        if ($biodata) {
            return view('user.biodata.show', compact('biodata'));
        }

        return view('user.biodata.create');
    }

    /**
     * Show the form for creating biodata
     */
    public function create()
    {
        // Check if biodata already exists
        $exists = Biodata::where('user_id', Auth::id())->exists();
        
        if ($exists) {
            return redirect()->route('user.biodata.index')
                ->with('info', 'Anda sudah memiliki biodata. Silakan edit jika ingin mengubah.');
        }

        return view('user.biodata.create');
    }

    /**
     * Store newly created biodata
     */
    public function store(Request $request)
    {
        // Check if biodata already exists
        $exists = Biodata::where('user_id', Auth::id())->exists();
        
        if ($exists) {
            return redirect()->route('user.biodata.index')
                ->with('error', 'Anda sudah memiliki biodata.');
        }

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:biodata,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',
            'no_hp' => 'required|digits_between:10,15',
            'email' => 'nullable|email',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_diri' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['kewarganegaraan'] = 'WNI';

        // Handle file uploads
        foreach (['foto_ktp', 'foto_kk', 'foto_diri'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $fileName = time() . '_' . $fileField . '_' . $file->getClientOriginalName();
                $file->storeAs('biodata', $fileName, 'public');
                $validated[$fileField] = $fileName;
            }
        }

        Biodata::create($validated);

        return redirect()->route('user.biodata.index')
            ->with('success', 'Biodata berhasil disimpan!');
    }

    /**
     * Show the form for editing biodata
     */
    public function edit()
    {
        $biodata = Biodata::where('user_id', Auth::id())->firstOrFail();

        // Jika sudah terverifikasi, tidak bisa edit
        if ($biodata->status_verifikasi === 'terverifikasi') {
            return redirect()->route('user.biodata.index')
                ->with('error', 'Biodata yang sudah terverifikasi tidak dapat diubah. Hubungi admin jika ada perubahan.');
        }

        return view('user.biodata.edit', compact('biodata'));
    }

    /**
     * Update the biodata
     */
    public function update(Request $request)
    {
        $biodata = Biodata::where('user_id', Auth::id())->firstOrFail();

        // Jika sudah terverifikasi, tidak bisa edit
        if ($biodata->status_verifikasi === 'terverifikasi') {
            return redirect()->route('user.biodata.index')
                ->with('error', 'Biodata yang sudah terverifikasi tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:biodata,nik,' . $biodata->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',
            'no_hp' => 'required|digits_between:10,15',
            'email' => 'nullable|email',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_diri' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Handle file uploads
        foreach (['foto_ktp', 'foto_kk', 'foto_diri'] as $fileField) {
            if ($request->hasFile($fileField)) {
                // Delete old file
                if ($biodata->$fileField) {
                    Storage::disk('public')->delete('biodata/' . $biodata->$fileField);
                }

                // Upload new file
                $file = $request->file($fileField);
                $fileName = time() . '_' . $fileField . '_' . $file->getClientOriginalName();
                $file->storeAs('biodata', $fileName, 'public');
                $validated[$fileField] = $fileName;
            }
        }

        // Reset status verifikasi jika ada perubahan
        $validated['status_verifikasi'] = 'belum_verifikasi';
        $validated['catatan_admin'] = null;

        $biodata->update($validated);

        return redirect()->route('user.biodata.index')
            ->with('success', 'Biodata berhasil diperbarui!');
    }

    // ========== ADMIN METHODS ==========

    /**
     * Display all biodata for admin
     */
    public function adminIndex(Request $request)
    {
        $query = Biodata::with('user');

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status_verifikasi', $request->status);
        }

        $biodata = $query->orderBy('created_at', 'desc')->paginate(15);

        $statistik = [
            'belum_verifikasi' => Biodata::where('status_verifikasi', 'belum_verifikasi')->count(),
            'sedang_diverifikasi' => Biodata::where('status_verifikasi', 'sedang_diverifikasi')->count(),
            'terverifikasi' => Biodata::where('status_verifikasi', 'terverifikasi')->count(),
            'ditolak' => Biodata::where('status_verifikasi', 'ditolak')->count(),
            'total' => Biodata::count(),
        ];

        return view('admin.biodata.index', compact('biodata', 'statistik'));
    }

    /**
     * Show detail biodata for admin
     */
    public function adminShow($id)
    {
        $biodata = Biodata::with(['user', 'verifiedBy'])->findOrFail($id);

        return view('admin.biodata.show', compact('biodata'));
    }

    /**
     * Verify biodata
     */
    public function adminVerify(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:sedang_diverifikasi,terverifikasi,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $biodata = Biodata::findOrFail($id);

        $biodata->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_admin' => $request->catatan_admin,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.biodata.show', $id)
            ->with('success', 'Status verifikasi berhasil diperbarui!');
    }
}