<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of admins
     */
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.admin-management.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create()
    {
        return view('admin.admin-management.create');
    }

    /**
     * Store a newly created admin in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admin,username',
            'email' => 'required|email|max:100|unique:admin,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.max' => 'Username maksimal 50 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        try {
            DB::table('admin')->insert([
                'nama_lengkap' => $validated['nama_lengkap'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.admin-management.index')
                ->with('success', 'Admin berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan admin: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified admin
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin-management.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin-management.edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('admin', 'username')->ignore($id)
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('admin', 'email')->ignore($id)
            ],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
        ]);

        try {
            DB::table('admin')
                ->where('id', $id)
                ->update([
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'username' => $validated['username'],
                    'email' => $validated['email'],
                    'updated_at' => now(),
                ]);

            return redirect()->route('admin.admin-management.index')
                ->with('success', 'Admin berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui admin: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified admin from storage
     */
    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);

            // Prevent deleting own account
            if ($admin->id == auth()->guard('admin')->id()) {
                return redirect()->back()
                    ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri');
            }

            // Prevent deleting if it's the last admin
            if (Admin::count() <= 1) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus admin terakhir');
            }

            DB::table('admin')->where('id', $id)->delete();

            return redirect()->route('admin.admin-management.index')
                ->with('success', 'Admin berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus admin: ' . $e->getMessage());
        }
    }

    /**
     * Reset password for specified admin
     */
    public function resetPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        try {
            DB::table('admin')
                ->where('id', $id)
                ->update([
                    'password' => Hash::make($validated['password']),
                    'updated_at' => now(),
                ]);

            return redirect()->back()
                ->with('success', 'Password admin berhasil direset');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mereset password: ' . $e->getMessage());
        }
    }
}
