<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::latest()->paginate(10);
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'fasilitas_jurusan' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi',
            'nama_jurusan.max' => 'Nama jurusan maksimal 100 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->nama_jurusan) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('jurusan', $filename, 'public');
            $validated['gambar'] = $path;
        }

        Jurusan::create($validated);

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'fasilitas_jurusan' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi',
            'nama_jurusan.max' => 'Nama jurusan maksimal 100 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
                Storage::disk('public')->delete($jurusan->gambar);
            }

            $gambar = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->nama_jurusan) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('jurusan', $filename, 'public');
            $validated['gambar'] = $path;
        }

        $jurusan->update($validated);

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Hapus gambar jika ada
        if ($jurusan->gambar && Storage::disk('public')->exists($jurusan->gambar)) {
            Storage::disk('public')->delete($jurusan->gambar);
        }

        $jurusan->delete();

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus');
    }
}
