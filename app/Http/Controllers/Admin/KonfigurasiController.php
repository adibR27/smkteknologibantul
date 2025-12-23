<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $konfigurasi = Konfigurasi::first();

        // Jika belum ada konfigurasi, buat default
        if (!$konfigurasi) {
            $konfigurasi = Konfigurasi::create([
                'nama_sekolah' => 'SMK Teknologi Bantul',
                'alamat' => '',
                'no_telepon' => '',
                'email' => '',
                'deskripsi' => '',
                'meta_keywords' => '',
            ]);
        }

        // Ambil semua media sosial
        $mediaSosial = MediaSosial::orderBy('created_at', 'asc')->get();

        return view('admin.konfigurasi.index', compact('konfigurasi', 'mediaSosial'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
            'deskripsi' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Ambil atau buat konfigurasi baru
        $konfigurasi = Konfigurasi::first();

        if (!$konfigurasi) {
            $konfigurasi = new Konfigurasi();
        }

        // Update data text
        $konfigurasi->nama_sekolah = $request->nama_sekolah;
        $konfigurasi->alamat = $request->alamat;
        $konfigurasi->no_telepon = $request->no_telepon;
        $konfigurasi->email = $request->email;
        $konfigurasi->deskripsi = $request->deskripsi;
        $konfigurasi->meta_keywords = $request->meta_keywords;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            try {
                $logoFile = $request->file('logo');

                if ($logoFile->isValid()) {
                    // Hapus logo lama
                    if ($konfigurasi->logo && Storage::disk('public')->exists($konfigurasi->logo)) {
                        Storage::disk('public')->delete($konfigurasi->logo);
                    }

                    // Simpan logo baru
                    $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
                    $logoPath = $logoFile->storeAs('konfigurasi', $logoName, 'public');
                    $konfigurasi->logo = $logoPath;
                }
            } catch (\Exception $e) {
                Log::error('Error upload logo: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal upload logo: ' . $e->getMessage());
            }
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            try {
                $faviconFile = $request->file('favicon');

                if ($faviconFile->isValid()) {
                    // Hapus favicon lama
                    if ($konfigurasi->favicon && Storage::disk('public')->exists($konfigurasi->favicon)) {
                        Storage::disk('public')->delete($konfigurasi->favicon);
                    }

                    // Simpan favicon baru
                    $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
                    $faviconPath = $faviconFile->storeAs('konfigurasi', $faviconName, 'public');
                    $konfigurasi->favicon = $faviconPath;
                }
            } catch (\Exception $e) {
                Log::error('Error upload favicon: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal upload favicon: ' . $e->getMessage());
            }
        }

        // Simpan perubahan
        $konfigurasi->save();

        return redirect()->route('admin.konfigurasi.index')
            ->with('success', 'Konfigurasi berhasil diperbarui!');
    }

    public function deleteLogo()
    {
        $konfigurasi = Konfigurasi::first();

        if ($konfigurasi && $konfigurasi->logo) {
            if (Storage::disk('public')->exists($konfigurasi->logo)) {
                Storage::disk('public')->delete($konfigurasi->logo);
            }
            $konfigurasi->logo = null;
            $konfigurasi->save();

            return response()->json(['success' => true, 'message' => 'Logo berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Logo tidak ditemukan'], 404);
    }

    public function deleteFavicon()
    {
        $konfigurasi = Konfigurasi::first();

        if ($konfigurasi && $konfigurasi->favicon) {
            if (Storage::disk('public')->exists($konfigurasi->favicon)) {
                Storage::disk('public')->delete($konfigurasi->favicon);
            }
            $konfigurasi->favicon = null;
            $konfigurasi->save();

            return response()->json(['success' => true, 'message' => 'Favicon berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Favicon tidak ditemukan'], 404);
    }

    // Media Sosial Methods
    public function storeMediaSosial(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:50',
            'link_url' => 'required|url|max:255',
            'icon' => 'required|string|max:100',
        ], [
            'platform.required' => 'Nama platform wajib diisi',
            'link_url.required' => 'Link URL wajib diisi',
            'link_url.url' => 'Link URL harus valid',
            'icon.required' => 'Icon wajib dipilih',
        ]);

        MediaSosial::create([
            'platform' => $request->platform,
            'link_url' => $request->link_url,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.konfigurasi.index')
            ->with('success', 'Media sosial berhasil ditambahkan!');
    }

    public function updateMediaSosial(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string|max:50',
            'link_url' => 'required|url|max:255',
            'icon' => 'required|string|max:100',
        ]);

        $mediaSosial = MediaSosial::findOrFail($id);
        $mediaSosial->update([
            'platform' => $request->platform,
            'link_url' => $request->link_url,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.konfigurasi.index')
            ->with('success', 'Media sosial berhasil diupdate!');
    }

    public function deleteMediaSosial($id)
    {
        $mediaSosial = MediaSosial::findOrFail($id);
        $mediaSosial->delete();

        return response()->json(['success' => true, 'message' => 'Media sosial berhasil dihapus']);
    }
}
