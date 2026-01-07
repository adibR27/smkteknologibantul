@extends('layouts.app')

@section('title', 'Guru & Tenaga Pendidik')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-20 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">
                    <i class="fas fa-chalkboard-teacher mr-3"></i>
                    Guru & Tenaga Pendidik
                </h1>
                <p class="mx-auto max-w-2xl text-lg text-blue-100">
                    Tenaga pendidik profesional dan berpengalaman yang siap membimbing siswa menuju kesuksesan
                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="font-medium text-blue-600">Guru</span>
            </div>
        </div>
    </section>

    <!-- Guru List Section -->
    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4">

            @if ($guru->count() > 0)
                <!-- Stats -->
                <div class="mb-12 text-center">
                    <h2 class="mb-2 text-3xl font-bold text-gray-800">
                        Daftar Guru
                    </h2>
                    <p class="text-gray-600">
                        Total <span class="font-bold text-blue-600">{{ $guru->count() }}</span> tenaga pendidik
                    </p>
                </div>

                <!-- Guru Table -->
                <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Foto</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama Lengkap</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Mata Pelajaran</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Jabatan</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold">Pendidikan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($guru as $index => $item)
                                    <tr class="transition hover:bg-blue-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                    alt="{{ $item->nama_lengkap }}"
                                                    class="h-12 w-12 rounded-full object-cover">
                                            @else
                                                <div
                                                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-200">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">
                                                {{ $item->nama_lengkap }}
                                            </div>
                                            @if ($item->email)
                                                <div class="text-xs text-gray-500">
                                                    {{ $item->email }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->mata_pelajaran ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->jabatan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->pendidikan_terakhir ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="py-20 text-center">
                    <div class="mx-auto max-w-md">
                        <div class="mb-6 text-gray-300">
                            <i class="fas fa-users text-9xl"></i>
                        </div>
                        <h3 class="mb-2 text-2xl font-bold text-gray-800">Belum Ada Data Guru</h3>
                        <p class="text-gray-600">
                            Data guru dan tenaga pendidik belum tersedia saat ini
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
