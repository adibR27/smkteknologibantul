@extends('admin.layouts.app')

@section('title', 'Profile Admin')
@section('page-title', 'Profile')
@section('page-subtitle', 'Kelola informasi akun Anda')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Profil Administrator</h2>
            <p class="mt-1 text-sm text-gray-500">Kelola informasi akun dan keamanan Anda</p>
        </div>

        <!-- Main Content -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Sidebar Profile Info -->
            <div class="lg:col-span-1">
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Akun</h3>
                    </div>
                    <div class="p-6">
                        <!-- Avatar -->
                        <div class="mb-6 text-center">
                            <div
                                class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-5xl font-bold text-white shadow-lg">
                                {{ strtoupper(substr($admin->nama_lengkap, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Quick Info -->
                        <div class="space-y-4">
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $admin->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Username</p>
                                <p class="font-semibold text-gray-800">{{ $admin->username }}</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Email</p>
                                <p class="font-semibold text-gray-800">{{ $admin->email }}</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Role</p>
                                <span
                                    class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Administrator
                                </span>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div class="mt-6 space-y-3">
                            <div class="rounded-lg bg-blue-50 p-3">
                                <p class="mb-1 text-xs text-gray-600">
                                    <i class="fas fa-calendar-plus mr-1"></i>Terdaftar sejak
                                </p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $admin->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="rounded-lg bg-green-50 p-3">
                                <p class="mb-1 text-xs text-gray-600">
                                    <i class="fas fa-clock mr-1"></i>Terakhir diubah
                                </p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $admin->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <!-- Edit Profile Form -->
                <div class="mb-6 overflow-hidden rounded-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">
                            <i class="fas fa-user-edit mr-2"></i>
                            Edit Informasi Profile
                        </h3>
                    </div>

                    <form action="{{ route('admin.profile.update') }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-user mr-2 text-gray-400"></i>
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    value="{{ old('nama_lengkap', $admin->nama_lengkap) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    required>
                                @error('nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-at mr-2 text-gray-400"></i>
                                    Username <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', $admin->username) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    required>
                                @error('username')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $admin->email) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex flex-wrap gap-3">
                            <button type="submit"
                                class="inline-flex items-center space-x-2 rounded-lg bg-blue-600 px-6 py-2.5 font-semibold text-white transition hover:bg-blue-700">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 font-semibold text-gray-700 transition hover:bg-gray-50">
                                <i class="fas fa-times"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">
                            <i class="fas fa-key mr-2"></i>
                            Ubah Password
                        </h3>
                    </div>

                    <form action="{{ route('admin.profile.update-password') }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')

                        <!-- Alert Info -->
                        <div class="mb-6 rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle mr-3 mt-1 text-yellow-600"></i>
                                <div>
                                    <p class="text-sm font-semibold text-yellow-800">Perhatian!</p>
                                    <p class="mt-1 text-sm text-yellow-700">
                                        Setelah mengubah password, Anda akan tetap login di sesi saat ini.
                                        Pastikan Anda mengingat password baru untuk login berikutnya.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Password Saat Ini -->
                            <div>
                                <label for="current_password" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>
                                    Password Saat Ini <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        required>
                                    <button type="button" onclick="togglePassword('current_password')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-eye" id="current_password-icon"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div>
                                <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-key mr-2 text-gray-400"></i>
                                    Password Baru <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        required>
                                    <button type="button" onclick="togglePassword('password')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>Minimal 8 karakter
                                </p>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-check-circle mr-2 text-gray-400"></i>
                                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        required>
                                    <button type="button" onclick="togglePassword('password_confirmation')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex flex-wrap gap-3">
                            <button type="submit"
                                class="inline-flex items-center space-x-2 rounded-lg bg-orange-600 px-6 py-2.5 font-semibold text-white transition hover:bg-orange-700">
                                <i class="fas fa-key"></i>
                                <span>Ubah Password</span>
                            </button>
                            <button type="reset"
                                class="inline-flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 font-semibold text-gray-700 transition hover:bg-gray-50">
                                <i class="fas fa-undo"></i>
                                <span>Reset</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endpush
