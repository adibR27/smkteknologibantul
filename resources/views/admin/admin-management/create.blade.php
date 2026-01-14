@extends('admin.layouts.app')

@section('title', 'Tambah Admin')
@section('page-title', 'Tambah Admin')
@section('page-subtitle', 'Buat akun administrator baru')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <!-- Header -->
            <div class="mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                    Tambah Administrator Baru
                </h2>
                <p class="mt-1 text-sm text-gray-500">Lengkapi formulir untuk membuat akun admin baru</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.admin-management.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="mb-2 block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-gray-400"></i>
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Masukkan nama lengkap" required>
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
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Masukkan username" required>
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>Username akan digunakan untuk login
                        </p>
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
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="admin@example.com" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-800">
                            <i class="fas fa-lock mr-2 text-orange-600"></i>
                            Keamanan Akun
                        </h3>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                            <i class="fas fa-key mr-2 text-gray-400"></i>
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="Minimal 8 karakter" required>
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
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                placeholder="Ulangi password" required>
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

                    <!-- Alert Info -->
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle mr-3 mt-1 text-blue-600"></i>
                            <div>
                                <p class="text-sm font-semibold text-blue-800">Informasi</p>
                                <p class="mt-1 text-sm text-blue-700">
                                    Admin baru akan dapat login menggunakan username dan password yang dibuat di sini.
                                    Pastikan untuk menyimpan kredensial dengan aman.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-wrap gap-3 border-t border-gray-200 pt-6">
                    <button type="submit"
                        class="inline-flex items-center space-x-2 rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">
                        <i class="fas fa-save"></i>
                        <span>Simpan Admin</span>
                    </button>
                    <a href="{{ route('admin.admin-management.index') }}"
                        class="inline-flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 transition hover:bg-gray-50">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
