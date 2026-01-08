<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::with('jurusan')
            ->orderBy('tahun_lulus', 'desc')
            ->paginate(10);

        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.alumni.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'pesan_alumni' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka',
            'tahun_lulus.min' => 'Tahun lulus tidak valid',
            'tahun_lulus.max' => 'Tahun lulus tidak boleh melebihi tahun depan',
            'jurusan_id.exists' => 'Jurusan tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        Alumni::create($validated);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $jurusan = Jurusan::all();

        return view('admin.alumni.edit', compact('alumni', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'pesan_alumni' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka',
            'tahun_lulus.min' => 'Tahun lulus tidak valid',
            'tahun_lulus.max' => 'Tahun lulus tidak boleh melebihi tahun depan',
            'jurusan_id.exists' => 'Jurusan tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto && Storage::disk('public')->exists($alumni->foto)) {
                Storage::disk('public')->delete($alumni->foto);
            }

            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumni->update($validated);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil diperbarui');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        // Hapus foto jika ada
        if ($alumni->foto && Storage::disk('public')->exists($alumni->foto)) {
            Storage::disk('public')->delete($alumni->foto);
        }

        $alumni->delete();

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil dihapus');
    }
}
