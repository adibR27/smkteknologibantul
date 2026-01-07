<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    private $gambarPath = 'struktur-organisasi/struktur.jpg';

    /**
     * Display the current struktur organisasi
     */
    public function index()
    {
        $gambarExists = Storage::disk('public')->exists($this->gambarPath);
        $gambarUrl = $gambarExists ? asset('storage/' . $this->gambarPath) : null;

        return view('admin.struktur-organisasi.index', compact('gambarUrl'));
    }

    /**
     * Show the form for uploading struktur organisasi
     */
    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    /**
     * Store/Update the struktur organisasi image
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
        ], [
            'gambar.required' => 'Gambar struktur organisasi wajib diupload',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        try {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($this->gambarPath)) {
                Storage::disk('public')->delete($this->gambarPath);
            }

            // Simpan gambar baru dengan nama tetap
            $gambar = $request->file('gambar');
            $gambar->storeAs('struktur-organisasi', 'struktur.jpg', 'public');

            return redirect()
                ->route('admin.struktur-organisasi.index')
                ->with('success', 'Struktur Organisasi berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengupload gambar: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing struktur organisasi
     */
    public function edit()
    {
        $gambarExists = Storage::disk('public')->exists($this->gambarPath);
        $gambarUrl = $gambarExists ? asset('storage/' . $this->gambarPath) : null;

        return view('admin.struktur-organisasi.edit', compact('gambarUrl'));
    }

    /**
     * Update the struktur organisasi image
     */
    public function update(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Remove the struktur organisasi image
     */
    public function destroy()
    {
        try {
            if (Storage::disk('public')->exists($this->gambarPath)) {
                Storage::disk('public')->delete($this->gambarPath);

                return redirect()
                    ->route('admin.struktur-organisasi.index')
                    ->with('success', 'Struktur Organisasi berhasil dihapus!');
            }

            return redirect()
                ->route('admin.struktur-organisasi.index')
                ->with('error', 'Gambar tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}
