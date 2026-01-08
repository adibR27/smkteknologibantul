@extends('layouts.app')

@section('title', $alumni->nama_lengkap . ' - Alumni')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>
                <span class="mx-2">/</span>
                <a href="{{ route('alumni.index') }}" class="hover:text-blue-600">Alumni</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $alumni->nama_lengkap }}</span>
            </nav>
        </div>
    </section>

    <!-- Alumni Detail Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-5xl">
                <div class="overflow-hidden rounded-2xl bg-white shadow-2xl">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                        <!-- Left Column - Photo -->
                        <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-8 md:col-span-1">
                            <div class="sticky top-8">
                                @if ($alumni->foto)
                                    <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama_lengkap }}"
                                        class="mx-auto mb-6 h-64 w-64 rounded-2xl object-cover shadow-xl">
                                @else
                                    <div
                                        class="mx-auto mb-6 flex h-64 w-64 items-center justify-center rounded-2xl bg-white shadow-xl">
                                        <i class="fas fa-user-graduate text-8xl text-blue-300"></i>
                                    </div>
                                @endif

                                <!-- Badge Tahun Lulus -->
                                <div class="mb-4 text-center">
                                    <div class="inline-block rounded-full bg-blue-600 px-6 py-3 shadow-lg">
                                        <i class="fas fa-graduation-cap mr-2 text-white"></i>
                                        <span class="text-xl font-bold text-white">Lulus {{ $alumni->tahun_lulus }}</span>
                                    </div>
                                </div>

                                <!-- Share Buttons -->
                                <div class="mt-6 text-center">
                                    <p class="mb-3 text-sm font-semibold text-gray-700">Bagikan Profil:</p>
                                    <div class="flex justify-center gap-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                            target="_blank"
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white transition hover:bg-blue-700"
                                            title="Share ke Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($alumni->nama_lengkap . ' - Alumni SMK Teknologi Bantul') }}"
                                            target="_blank"
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-500 text-white transition hover:bg-sky-600"
                                            title="Share ke Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode($alumni->nama_lengkap . ' - Alumni SMK Teknologi Bantul ' . request()->url()) }}"
                                            target="_blank"
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white transition hover:bg-green-700"
                                            title="Share ke WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Info -->
                        <div class="p-8 md:col-span-2">
                            <!-- Nama -->
                            <h1 class="mb-6 text-4xl font-bold text-gray-800">{{ $alumni->nama_lengkap }}</h1>

                            <!-- Info Cards -->
                            <div class="mb-8 space-y-4">
                                <!-- Jurusan -->
                                @if ($alumni->jurusan)
                                    <div class="flex items-start gap-4 rounded-lg bg-blue-50 p-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white">
                                            <i class="fas fa-book text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Jurusan</p>
                                            <p class="text-lg font-bold text-gray-800">{{ $alumni->jurusan->nama_jurusan }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Pekerjaan -->
                                @if ($alumni->pekerjaan_sekarang)
                                    <div class="flex items-start gap-4 rounded-lg bg-green-50 p-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-white">
                                            <i class="fas fa-briefcase text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Pekerjaan Saat Ini</p>
                                            <p class="text-lg font-bold text-gray-800">{{ $alumni->pekerjaan_sekarang }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Pesan Alumni -->
                            @if ($alumni->pesan_alumni)
                                <div class="mb-8 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 p-6">
                                    <h2 class="mb-4 flex items-center text-2xl font-bold text-gray-800">
                                        <i class="fas fa-quote-left mr-3 text-blue-600"></i>
                                        Pesan & Testimoni
                                    </h2>
                                    <blockquote class="italic leading-relaxed text-gray-700">
                                        <p class="text-lg">{{ $alumni->pesan_alumni }}</p>
                                    </blockquote>
                                    <div class="mt-4 text-right">
                                        <i class="fas fa-quote-right text-3xl text-blue-600 opacity-30"></i>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('alumni.index') }}"
                                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 transition hover:bg-gray-50">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali ke Daftar Alumni
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alumni Lainnya Section -->
    @if ($alumniLainnya->count() > 0)
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-800">Alumni Lainnya</h2>
                    <p class="text-gray-600">
                        @if ($alumni->jurusan)
                            Alumni dari {{ $alumni->jurusan->nama_jurusan }}
                        @else
                            Lulusan lainnya dari SMK Teknologi Bantul
                        @endif
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($alumniLainnya as $item)
                        <div
                            class="group transform overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-100 to-blue-200">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <i class="fas fa-user-graduate text-6xl text-blue-300"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute right-2 top-2 rounded-full bg-blue-600 px-2 py-1 text-xs font-semibold text-white">
                                    {{ $item->tahun_lulus }}
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="mb-2 text-lg font-bold text-gray-800">{{ $item->nama_lengkap }}</h3>
                                @if ($item->jurusan)
                                    <p class="mb-2 text-sm text-gray-600">
                                        <i class="fas fa-book mr-1 text-blue-500"></i>{{ $item->jurusan->nama_jurusan }}
                                    </p>
                                @endif
                                <a href="{{ route('alumni.show', $item->id) }}"
                                    class="mt-3 inline-block w-full rounded-lg bg-blue-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-blue-700">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
