<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('tanggal_kirim', 'desc')->paginate(15);
        
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function destroy($id)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($id);
            $pengaduan->delete();

            return redirect()
                ->route('admin.pengaduan.index')
                ->with('success', 'Pengaduan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus pengaduan');
        }
    }
}