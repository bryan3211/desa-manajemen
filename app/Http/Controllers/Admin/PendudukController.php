<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendudukController extends Controller
{
    /**
     * Display a listing of penduduk
     */
    public function index(Request $request)
    {
        $query = Penduduk::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search berdasarkan NIK atau Nama
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%")
                  ->orWhere('nama_lengkap', 'like', "%$search%");
            });
        }

        $penduduk = $query->orderBy('nama_lengkap')->paginate(15);

        $statistik = [
            'total' => Penduduk::count(),
            'aktif' => Penduduk::where('status', 'aktif')->count(),
            'tidak_aktif' => Penduduk::where('status', 'tidak_aktif')->count(),
            'meninggal' => Penduduk::where('status', 'meninggal')->count(),
            'pindah' => Penduduk::where('status', 'pindah')->count(),
        ];

        return view('admin.penduduk.index', compact('penduduk', 'statistik'));
    }

    /**
     * Show form to create penduduk
     */
    public function create()
    {
        return view('admin.penduduk.create');
    }

    /**
     * Store penduduk data
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',
            'no_hp' => 'nullable|digits_between:10,15',
            'email' => 'nullable|email|unique:penduduk,email',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'status' => 'required|in:aktif,tidak_aktif,meninggal,pindah',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('penduduk', $fileName, 'public');
            $validated['foto'] = $fileName;
        }

        Penduduk::create($validated);

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    /**
     * Show penduduk detail
     */
    public function show($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('admin.penduduk.show', compact('penduduk'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    /**
     * Update penduduk data
     */
    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:penduduk,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|digits:5',
            'no_hp' => 'nullable|digits_between:10,15',
            'email' => 'nullable|email|unique:penduduk,email,' . $id,
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|in:SD,SMP,SMA,D3,S1,S2,S3',
            'status' => 'required|in:aktif,tidak_aktif,meninggal,pindah',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $validated['updated_by'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file
            if ($penduduk->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('penduduk/' . $penduduk->foto);
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('penduduk', $fileName, 'public');
            $validated['foto'] = $fileName;
        }

        $penduduk->update($validated);

        return redirect()->route('admin.penduduk.show', $id)
            ->with('success', 'Data penduduk berhasil diperbarui');
    }

    /**
     * Delete penduduk
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::findOrFail($id);

        if ($penduduk->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('penduduk/' . $penduduk->foto);
        }

        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus');
    }

    /**
     * Export data penduduk
     */
    public function export()
    {
        $penduduk = Penduduk::all();
        
        $csv = "NIK,Nama,Tempat Lahir,Tanggal Lahir,Jenis Kelamin,Alamat,No. HP,Email,Status\n";
        
        foreach ($penduduk as $p) {
            $csv .= "{$p->nik},{$p->nama_lengkap},{$p->tempat_lahir},{$p->tanggal_lahir},{$p->jenis_kelamin},";
            $csv .= "{$p->alamat},{$p->no_hp},{$p->email},{$p->status_label}\n";
        }

        return response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="penduduk.csv"');
    }
}