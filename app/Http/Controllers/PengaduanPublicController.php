<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanPublicController extends Controller
{
    public function index()
    {
        return view('pengaduan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 100 karakter',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'pesan.required' => 'Pesan pengaduan wajib diisi',
        ]);

        try {
            Pengaduan::create($validated);

            return redirect()
                ->route('pengaduan.index')
                ->with('success', 'Pengaduan Anda telah berhasil dikirim. Terima kasih atas partisipasi Anda.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim pengaduan. Silakan coba lagi.');
        }
    }
}
