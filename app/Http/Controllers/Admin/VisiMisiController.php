<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display visi misi
     */
    public function index()
    {
        $visiMisi = VisiMisi::first();

        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    /**
     * Show form for creating or editing
     */
    public function edit()
    {
        $visiMisi = VisiMisi::first();

        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    /**
     * Store or update visi misi
     */
    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ], [
            'visi.required' => 'Visi wajib diisi',
            'misi.required' => 'Misi wajib diisi',
        ]);

        try {
            $visiMisi = VisiMisi::first();

            if ($visiMisi) {
                // Update existing
                $visiMisi->update([
                    'visi' => $request->visi,
                    'misi' => $request->misi,
                ]);
            } else {
                // Create new
                VisiMisi::create([
                    'visi' => $request->visi,
                    'misi' => $request->misi,
                ]);
            }

            return redirect()
                ->route('admin.visi-misi.index')
                ->with('success', 'Visi & Misi berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
