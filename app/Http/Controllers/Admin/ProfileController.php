<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    /**
     * Update informasi profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('admin', 'email')->ignore($admin->id)
            ],
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('admin', 'username')->ignore($admin->id)
            ],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.max' => 'Username maksimal 50 karakter',
        ]);

        try {
            // Menggunakan DB query builder untuk update
            DB::table('admin')
                ->where('id', $admin->id)
                ->update([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'email' => $validated['email'],
                    'username' => $validated['username'],
                    'updated_at' => now(),
                ]);

            // Refresh data admin di session
            Auth::guard('admin')->setUser(
                Admin::find($admin->id)
            );

            return redirect()->route('admin.profile.index')
                ->with('success', 'Profile berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        // Cek password saat ini
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai'
            ])->withInput();
        }

        try {
            // Update menggunakan DB query builder
            DB::table('admin')
                ->where('id', $admin->id)
                ->update([
                    'password' => Hash::make($request->password),
                    'updated_at' => now(),
                ]);

            return redirect()->route('admin.profile.index')
                ->with('success', 'Password berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui password: ' . $e->getMessage());
        }
    }
}
