@extends('admin.layouts.app')

@section('title', 'Detail Admin')
@section('page-title', 'Detail Admin')
@section('page-subtitle', 'Informasi lengkap administrator')

@section('content')
    <div class="mx-auto max-w-4xl">
        <div class="rounded-xl bg-white shadow-sm">
            <!-- Header -->
            <div class="border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-user-shield mr-2"></i>
                        Detail Administrator
                    </h2>
                    @if ($admin->id == auth()->guard('admin')->id())
                        <span class="rounded-full bg-white/20 px-3 py-1 text-sm font-semibold text-white">
                            <i class="fas fa-check-circle mr-1"></i>Akun Anda
                        </span>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid gap-6 lg:grid-cols-3">
                    <!-- Avatar Section -->
                    <div class="lg:col-span-1">
                        <div class="text-center">
                            <div
                                class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-5xl font-bold text-white shadow-lg">
                                {{ strtoupper(substr($admin->nama_lengkap, 0, 1)) }}
                            </div>
                            <h3 class="mt-4 text-xl font-bold text-gray-800">{{ $admin->nama_lengkap }}</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                <i class="fas fa-shield-alt mr-1"></i>Administrator
                            </p>
                        </div>

                        <!-- Meta Info -->
                        <div class="mt-6 space-y-3">
                            <div class="rounded-lg bg-blue-50 p-4">
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-600">
                                    <i class="fas fa-calendar-plus mr-1"></i>Terdaftar sejak
                                </p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $admin->created_at->format('d M Y') }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $admin->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="rounded-lg bg-green-50 p-4">
                                <p class="mb-1 text-xs font-semibold uppercase text-gray-600">
                                    <i class="fas fa-clock mr-1"></i>Terakhir diubah
                                </p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $admin->updated_at->format('d M Y, H:i') }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $admin->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="lg:col-span-2">
                        <div class="space-y-6">
                            <!-- Informasi Akun -->
                            <div>
                                <h4 class="mb-4 flex items-center text-lg font-semibold text-gray-800">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    Informasi Akun
                                </h4>
                                <div class="space-y-4">
                                    <div class="rounded-lg border border-gray-200 p-4">
                                        <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Nama Lengkap</p>
                                        <p class="text-base font-semibold text-gray-800">{{ $admin->nama_lengkap }}</p>
                                    </div>
                                    <div class="rounded-lg border border-gray-200 p-4">
                                        <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Username</p>
                                        <p class="text-base font-semibold text-gray-800">
                                            <i class="fas fa-at mr-2 text-gray-400"></i>{{ $admin->username }}
                                        </p>
                                    </div>
                                    <div class="rounded-lg border border-gray-200 p-4">
                                        <p class="mb-1 text-xs font-semibold uppercase text-gray-500">Email</p>
                                        <p class="text-base font-semibold text-gray-800">
                                            <i class="fas fa-envelope mr-2 text-gray-400"></i>{{ $admin->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Reset Password Section -->
                            @if ($admin->id != auth()->guard('admin')->id())
                                <div class="rounded-lg border-2 border-orange-200 bg-orange-50 p-4">
                                    <h4 class="mb-2 flex items-center text-base font-semibold text-orange-800">
                                        <i class="fas fa-key mr-2"></i>
                                        Reset Password
                                    </h4>
                                    <p class="mb-4 text-sm text-orange-700">
                                        Anda dapat mereset password admin ini jika diperlukan.
                                    </p>
                                    <button onclick="showResetPasswordModal()"
                                        class="inline-flex items-center space-x-2 rounded-lg bg-orange-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-700">
                                        <i class="fas fa-key"></i>
                                        <span>Reset Password</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3 border-t border-gray-200 pt-6">
                                <a href="{{ route('admin.admin-management.edit', $admin->id) }}"
                                    class="inline-flex items-center space-x-2 rounded-lg bg-yellow-500 px-6 py-2.5 font-semibold text-white transition hover:bg-yellow-600">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Data</span>
                                </a>
                                @if ($admin->id != auth()->guard('admin')->id())
                                    <button onclick="confirmDelete()"
                                        class="inline-flex items-center space-x-2 rounded-lg bg-red-500 px-6 py-2.5 font-semibold text-white transition hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus Admin</span>
                                    </button>
                                @endif
                                <a href="{{ route('admin.admin-management.index') }}"
                                    class="inline-flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-6 py-2.5 font-semibold text-gray-700 transition hover:bg-gray-50">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    @if ($admin->id != auth()->guard('admin')->id())
        <form id="deleteForm" action="{{ route('admin.admin-management.destroy', $admin->id) }}" method="POST"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    <!-- Reset Password Modal -->
    <div id="resetPasswordModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="mx-4 w-full max-w-md rounded-lg bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800">
                    <i class="fas fa-key mr-2 text-orange-600"></i>
                    Reset Password
                </h3>
                <button onclick="hideResetPasswordModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.admin-management.reset-password', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="modal_password" class="mb-2 block text-sm font-semibold text-gray-700">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="modal_password"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                required>
                            <button type="button" onclick="togglePassword('modal_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="modal_password-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="modal_password_confirmation" class="mb-2 block text-sm font-semibold text-gray-700">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="modal_password_confirmation"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-12 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                required>
                            <button type="button" onclick="togglePassword('modal_password_confirmation')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye" id="modal_password_confirmation-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit"
                        class="flex-1 rounded-lg bg-orange-600 px-4 py-2.5 font-semibold text-white transition hover:bg-orange-700">
                        <i class="fas fa-check mr-2"></i>Reset Password
                    </button>
                    <button type="button" onclick="hideResetPasswordModal()"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-semibold text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                document.getElementById('deleteForm').submit();
            }
        }

        function showResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.remove('hidden');
            document.getElementById('resetPasswordModal').classList.add('flex');
        }

        function hideResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.add('hidden');
            document.getElementById('resetPasswordModal').classList.remove('flex');
        }

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
