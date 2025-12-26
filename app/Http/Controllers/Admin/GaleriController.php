<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::with('uploader')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_kegiatan' => 'nullable|date',
        ], [
            'gambar.required' => 'Gambar wajib diupload',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid',
        ]);

        try {
            // Upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('galeri', $filename, 'public');
                $validated['gambar'] = $path;
            }

            // Tambahkan uploaded_by
            $validated['uploaded_by'] = Auth::guard('admin')->id();

            Galeri::create($validated);

            return redirect()
                ->route('admin.galeri.index')
                ->with('success', 'Foto berhasil ditambahkan ke galeri');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_kegiatan' => 'nullable|date',
        ], [
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid',
        ]);

        try {
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                    Storage::disk('public')->delete($galeri->gambar);
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('galeri', $filename, 'public');
                $validated['gambar'] = $path;
            }

            $galeri->update($validated);

            return redirect()
                ->route('admin.galeri.index')
                ->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        try {
            // Hapus file gambar
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }

            $galeri->delete();

            return redirect()
                ->route('admin.galeri.index')
                ->with('success', 'Foto berhasil dihapus dari galeri');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
