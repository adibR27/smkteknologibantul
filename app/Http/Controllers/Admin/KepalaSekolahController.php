<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepalaSekolahController extends Controller
{
    public function index()
    {
        $kepalaSekolah = KepalaSekolah::first();
        return view('admin.kepala-sekolah.index', compact('kepalaSekolah'));
    }

    public function create()
    {
        // Cek apakah sudah ada data kepala sekolah
        if (KepalaSekolah::exists()) {
            return redirect()->route('admin.kepala-sekolah.index')
                ->with('error', 'Data kepala sekolah sudah ada. Silakan edit data yang ada.');
        }

        return view('admin.kepala-sekolah.create');
    }

    public function store(Request $request)
    {
        // Cek apakah sudah ada data
        if (KepalaSekolah::exists()) {
            return redirect()->route('admin.kepala-sekolah.index')
                ->with('error', 'Data kepala sekolah sudah ada.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sambutan' => 'nullable|string'
        ], [
            'nama.required' => 'Nama kepala sekolah wajib diisi',
            'nama.max' => 'Nama maksimal 100 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, jpg, atau png',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kepala_sekolah', 'public');
        }

        KepalaSekolah::create($validated);

        return redirect()->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil ditambahkan');
    }

    public function edit()
    {
        $kepalaSekolah = KepalaSekolah::first();

        if (!$kepalaSekolah) {
            return redirect()->route('admin.kepala-sekolah.create')
                ->with('error', 'Data kepala sekolah belum ada. Silakan tambahkan terlebih dahulu.');
        }

        return view('admin.kepala-sekolah.edit', compact('kepalaSekolah'));
    }

    public function update(Request $request)
    {
        $kepalaSekolah = KepalaSekolah::first();

        if (!$kepalaSekolah) {
            return redirect()->route('admin.kepala-sekolah.create')
                ->with('error', 'Data kepala sekolah tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sambutan' => 'nullable|string'
        ], [
            'nama.required' => 'Nama kepala sekolah wajib diisi',
            'nama.max' => 'Nama maksimal 100 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, jpg, atau png',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kepalaSekolah->foto && Storage::disk('public')->exists($kepalaSekolah->foto)) {
                Storage::disk('public')->delete($kepalaSekolah->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kepala_sekolah', 'public');
        }

        $kepalaSekolah->update($validated);

        return redirect()->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil diperbarui');
    }

    public function destroy()
    {
        $kepalaSekolah = KepalaSekolah::first();

        if (!$kepalaSekolah) {
            return redirect()->route('admin.kepala-sekolah.index')
                ->with('error', 'Data tidak ditemukan');
        }

        // Hapus foto jika ada
        if ($kepalaSekolah->foto && Storage::disk('public')->exists($kepalaSekolah->foto)) {
            Storage::disk('public')->delete($kepalaSekolah->foto);
        }

        $kepalaSekolah->delete();

        return redirect()->route('admin.kepala-sekolah.index')
            ->with('success', 'Data kepala sekolah berhasil dihapus');
    }

    public function deleteFoto()
    {
        $kepalaSekolah = KepalaSekolah::first();

        if (!$kepalaSekolah) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        if ($kepalaSekolah->foto && Storage::disk('public')->exists($kepalaSekolah->foto)) {
            Storage::disk('public')->delete($kepalaSekolah->foto);
            $kepalaSekolah->update(['foto' => null]);

            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan'], 404);
    }
}
