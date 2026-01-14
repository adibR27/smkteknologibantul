@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 py-20 text-white">
        <div class="container mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">Pengaduan Masyarakat</h1>
                <p class="text-lg text-blue-100 md:text-xl">
                    Sampaikan aspirasi, keluhan, atau saran Anda untuk kemajuan sekolah
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-16">
        <div class="container mx-auto max-w-4xl px-4">

            <!-- Alert Success -->
            @if (session('success'))
                <div
                    class="animate__animated animate__fadeInDown mb-6 rounded-lg border border-green-300 bg-green-100 p-4 text-green-700">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <div>
                            <p class="font-semibold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Alert Error -->
            @if (session('error'))
                <div
                    class="animate__animated animate__fadeInDown mb-6 rounded-lg border border-red-300 bg-red-100 p-4 text-red-700">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-2xl"></i>
                        <div>
                            <p class="font-semibold">Terjadi Kesalahan!</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Info Card -->
            <div class="mb-8 rounded-lg border border-blue-200 bg-blue-50 p-6">
                <div class="flex items-start gap-4">
                    <i class="fas fa-info-circle text-3xl text-blue-600"></i>
                    <div>
                        <h3 class="mb-2 text-lg font-semibold text-blue-900">Informasi Penting</h3>
                        <ul class="space-y-2 text-sm text-blue-800">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check mt-1 text-blue-600"></i>
                                <span>Pengaduan Anda akan diproses dan ditindaklanjuti oleh pihak sekolah</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check mt-1 text-blue-600"></i>
                                <span>Identitas pelapor akan dijaga kerahasiaannya</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check mt-1 text-blue-600"></i>
                                <span>Sampaikan pengaduan dengan bahasa yang sopan dan konstruktif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="rounded-lg bg-white p-8 shadow-lg">
                <form action="{{ route('pengaduan.store') }}" method="POST" id="pengaduanForm">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-6">
                        <label for="nama" class="mb-2 block font-semibold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="@error('nama') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Masukkan nama lengkap Anda" required>
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="mb-2 block font-semibold text-gray-700">
                            Email <span class="text-sm text-gray-400">(Opsional)</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="@error('email') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="contoh@email.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Pesan -->
                    <div class="mb-6">
                        <label for="pesan" class="mb-2 block font-semibold text-gray-700">
                            Isi Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="pesan" id="pesan" rows="8"
                            class="@error('pesan') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Tuliskan pengaduan, saran, atau keluhan Anda secara jelas dan detail..." required>{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle"></i> Minimal 10 karakter
                        </p>
                    </div>

                    <!-- Button Submit -->
                    <div class="flex items-center justify-between gap-4">
                        <button type="submit"
                            class="flex items-center gap-2 rounded-lg bg-blue-600 px-8 py-3 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pengaduan
                        </button>

                        <button type="reset"
                            class="flex items-center gap-2 rounded-lg border-2 border-gray-300 px-8 py-3 font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none">
                            <i class="fas fa-redo"></i>
                            Reset Form
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="mt-8 rounded-lg border border-gray-200 bg-gray-50 p-6">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    <i class="fas fa-phone-alt text-blue-600"></i> Kontak Alternatif
                </h3>
                <p class="mb-4 text-gray-600">
                    Jika Anda memerlukan respon lebih cepat, Anda juga dapat menghubungi kami melalui:
                </p>
                <div class="grid gap-4 md:grid-cols-2">
                    @if ($globalKonfigurasi && $globalKonfigurasi->no_telepon)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-xl text-blue-600"></i>
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <p class="font-semibold text-gray-800">{{ $globalKonfigurasi->no_telepon }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($globalKonfigurasi && $globalKonfigurasi->email)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-xl text-blue-600"></i>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-semibold text-gray-800">{{ $globalKonfigurasi->email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Form validation
            document.getElementById('pengaduanForm').addEventListener('submit', function(e) {
                const pesan = document.getElementById('pesan').value.trim();

                if (pesan.length < 10) {
                    e.preventDefault();
                    alert('Pesan pengaduan minimal 10 karakter');
                    document.getElementById('pesan').focus();
                    return false;
                }
            });

            // Auto-hide success message after 5 seconds
            const successAlert = document.querySelector('.bg-green-100');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('animate__animated', 'animate__fadeOutUp');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 1000);
                }, 5000);
            }
        </script>
    @endpush
@endsection
