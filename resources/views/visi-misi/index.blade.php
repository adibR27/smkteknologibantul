@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center text-white">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">
                    <i class="fas fa-bullseye mr-3"></i>
                    Visi & Misi
                </h1>
                <p class="mx-auto max-w-2xl text-lg text-blue-100">
                    Visi dan Misi {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Visi Misi Content -->
    <section class="py-16">
        <div class="mx-auto max-w-5xl px-4">
            @if ($visiMisi)
                <!-- Visi Card -->
                <div class="mb-12 rounded-xl bg-white p-8 shadow-lg">
                    <div class="mb-6 flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-eye text-3xl text-blue-600"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">Visi</h2>
                    </div>

                    <div class="rounded-lg bg-blue-50 p-6">
                        <p class="whitespace-pre-line text-lg leading-relaxed text-gray-700">{{ $visiMisi->visi }}</p>
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="rounded-xl bg-white p-8 shadow-lg">
                    <div class="mb-6 flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                            <i class="fas fa-tasks text-3xl text-green-600"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">Misi</h2>
                    </div>

                    <div class="rounded-lg bg-green-50 p-6">
                        @php
                            // Split misi by newlines and filter empty lines
                            $misiLines = array_filter(explode("\n", $visiMisi->misi), fn($line) => !empty(trim($line)));
                        @endphp

                        @if (count($misiLines) > 1)
                            <ol class="space-y-4">
                                @foreach ($misiLines as $index => $line)
                                    <li class="flex gap-4">
                                        <span
                                            class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-green-600 text-sm font-bold text-white">
                                            {{ $index + 1 }}
                                        </span>
                                        <p class="pt-1 text-lg leading-relaxed text-gray-700">{{ trim($line) }}</p>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="whitespace-pre-line text-lg leading-relaxed text-gray-700">{{ $visiMisi->misi }}</p>
                        @endif
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="rounded-xl bg-white px-6 py-16 text-center shadow-lg">
                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
                        <i class="fas fa-bullseye text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="mb-2 text-2xl font-bold text-gray-800">Visi & Misi Belum Tersedia</h3>
                    <p class="text-gray-600">Informasi visi dan misi akan segera diperbarui</p>
                </div>
            @endif
        </div>
    </section>

 
@endsection
