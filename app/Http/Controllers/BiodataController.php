<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Tampilkan form biodata user
     */
    public function index()
    {
        // Cek apakah user sudah punya biodata
        $biodata = Biodata::where('user_id', Auth::id())->first();

        return view('user.biodata', compact('biodata'));
    }

    /**
     * Simpan data biodata user ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:biodatas,nik,' . Auth::id() . ',user_id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        // Simpan atau update data biodata
        Biodata::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated + ['user_id' => Auth::id()]
        );

        return redirect()->back()->with('success', '✅ Biodata berhasil disimpan!');
    }
}
