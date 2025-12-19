<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::orderBy('created_at', 'desc')->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'gambar.required' => 'Gambar wajib diupload',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = $request->only(['deskripsi']);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('carousel', 'public');
        }

        Carousel::create($data);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = $request->only(['deskripsi']);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($carousel->gambar && Storage::disk('public')->exists($carousel->gambar)) {
                Storage::disk('public')->delete($carousel->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('carousel', 'public');
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        // Hapus gambar dari storage
        if ($carousel->gambar && Storage::disk('public')->exists($carousel->gambar)) {
            Storage::disk('public')->delete($carousel->gambar);
        }

        $carousel->delete();

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil dihapus!');
    }
}
