<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('jurusan')->latest()->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.guru.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|max:100',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'jabatan' => 'nullable|string|max:100',
            'mata_pelajaran' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($validated);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('admin.guru.edit', compact('guru', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|max:100',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'jabatan' => 'nullable|string|max:100',
            'mata_pelajaran' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $validated['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($validated);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        // Hapus foto jika ada
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
