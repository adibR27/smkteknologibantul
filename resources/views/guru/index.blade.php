@extends('layouts.app')

@section('title', 'Guru & Tenaga Pendidik')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-800 to-blue-900 py-20 text-white">
        <div class="mx-auto max-w-7xl px-4">
            <div class="text-center">
                <h1 class="animate__animated animate__fadeInDown mb-4 text-4xl font-bold md:text-5xl">
                    <i class="fas fa-chalkboard-teacher mr-3"></i>
                    Guru & Tenaga Pendidik
                </h1>
                <p class="animate__animated animate__fadeInUp mx-auto max-w-2xl text-lg text-blue-100">
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

    <!-- Guru Section -->
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4">

            @if ($guru->count() > 0)
                <!-- Header dengan Toggle -->
                <div class="mb-12">
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <!-- Stats Info -->
                        <div class="text-center md:text-left">
                            <h2 class="mb-2 text-3xl font-bold text-gray-800">Daftar Guru</h2>
                            <p class="text-gray-600">
                                Total <span class="font-bold text-blue-600">{{ $guru->count() }}</span> tenaga pendidik
                            </p>
                        </div>

                        <!-- View Mode Toggle -->
                        <div class="flex items-center gap-2 rounded-lg bg-gray-100 p-1">
                            <button id="grid-view-btn"
                                class="view-toggle-btn {{ $viewMode === 'grid' ? 'active' : '' }} flex items-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition">
                                <i class="fas fa-th"></i>
                                <span class="hidden sm:inline">Grid</span>
                            </button>
                            <button id="list-view-btn"
                                class="view-toggle-btn {{ $viewMode === 'list' ? 'active' : '' }} flex items-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition">
                                <i class="fas fa-list"></i>
                                <span class="hidden sm:inline">List</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter by Jurusan -->
                <div class="mb-8 flex flex-wrap justify-center gap-3" id="filter-buttons">
                    <button
                        class="filter-btn active rounded-full bg-blue-600 px-6 py-2 text-sm font-medium text-white transition hover:bg-blue-700"
                        data-filter="all">
                        Semua Guru
                    </button>
                    @php
                        $jurusanList = $guru->pluck('jurusan')->unique()->filter();
                    @endphp
                    @foreach ($jurusanList as $jurusan)
                        @if ($jurusan)
                            <button
                                class="filter-btn rounded-full border border-blue-600 bg-white px-6 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50"
                                data-filter="{{ $jurusan->id }}">
                                {{ $jurusan->nama_jurusan }}
                            </button>
                        @endif
                    @endforeach
                </div>

                <!-- GRID VIEW -->
                <div id="grid-view" class="grid-view {{ $viewMode === 'grid' ? '' : 'hidden' }}">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($guru as $item)
                            <div class="guru-card group overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                                data-jurusan="{{ $item->jurusan_id ?? 'none' }}">

                                <!-- Foto Guru -->
                                <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 p-6">
                                    <div
                                        class="mx-auto h-40 w-40 overflow-hidden rounded-full border-4 border-white shadow-xl">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_lengkap }}"
                                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-200">
                                                <i class="fas fa-user text-6xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Info Guru -->
                                <div class="p-6">
                                    <!-- Nama -->
                                    <h3 class="mb-2 text-center text-xl font-bold text-gray-800">
                                        {{ $item->nama_lengkap }}
                                    </h3>

                                    <!-- Mata Pelajaran -->
                                    @if ($item->mata_pelajaran)
                                        <div class="mb-3 text-center">
                                            <span
                                                class="inline-block rounded-full bg-blue-100 px-4 py-1 text-sm font-medium text-blue-800">
                                                <i class="fas fa-book mr-1"></i>
                                                {{ $item->mata_pelajaran }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Detail Info -->
                                    <div class="space-y-2 border-t border-gray-100 pt-4 text-sm text-gray-600">
                                        @if ($item->jabatan)
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-briefcase mt-1 text-blue-600"></i>
                                                <span>{{ $item->jabatan }}</span>
                                            </div>
                                        @endif

                                        @if ($item->jurusan)
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-graduation-cap mt-1 text-blue-600"></i>
                                                <span>{{ $item->jurusan->nama_jurusan }}</span>
                                            </div>
                                        @endif

                                        @if ($item->pendidikan_terakhir)
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-user-graduate mt-1 text-blue-600"></i>
                                                <span>{{ $item->pendidikan_terakhir }}</span>
                                            </div>
                                        @endif

                                        @if ($item->email)
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-envelope mt-1 text-blue-600"></i>
                                                <a href="mailto:{{ $item->email }}"
                                                    class="break-all text-blue-600 hover:underline">
                                                    {{ $item->email }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- LIST VIEW -->
                <div id="list-view" class="list-view {{ $viewMode === 'list' ? '' : 'hidden' }}">
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
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Jurusan</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold">Pendidikan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($guru as $index => $item)
                                        <tr class="guru-row transition hover:bg-blue-50"
                                            data-jurusan="{{ $item->jurusan_id ?? 'none' }}">
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
                                                {{ $item->jurusan->nama_jurusan ?? '-' }}
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gridViewBtn = document.getElementById('grid-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');
            const filterButtons = document.querySelectorAll('.filter-btn');

            // Toggle View Mode
            function switchView(mode) {
                if (mode === 'grid') {
                    gridView.classList.remove('hidden');
                    listView.classList.add('hidden');
                    gridViewBtn.classList.add('active');
                    listViewBtn.classList.remove('active');
                    localStorage.setItem('guruViewMode', 'grid');
                } else {
                    gridView.classList.add('hidden');
                    listView.classList.remove('hidden');
                    listViewBtn.classList.add('active');
                    gridViewBtn.classList.remove('active');
                    localStorage.setItem('guruViewMode', 'list');
                }
            }

            // Load saved preference
            const savedView = localStorage.getItem('guruViewMode') || 'grid';
            switchView(savedView);

            gridViewBtn.addEventListener('click', () => switchView('grid'));
            listViewBtn.addEventListener('click', () => switchView('list'));

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');

                    // Update active button
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-blue-600', 'text-white');
                        btn.classList.add('border', 'border-blue-600', 'bg-white',
                            'text-blue-600');
                    });
                    this.classList.add('active', 'bg-blue-600', 'text-white');
                    this.classList.remove('border', 'border-blue-600', 'bg-white', 'text-blue-600');

                    // Filter grid cards
                    const guruCards = document.querySelectorAll('.guru-card');
                    guruCards.forEach(card => {
                        const cardJurusan = card.getAttribute('data-jurusan');
                        card.style.display = (filter === 'all' || cardJurusan === filter) ?
                            'block' : 'none';
                    });

                    // Filter list rows
                    const guruRows = document.querySelectorAll('.guru-row');
                    guruRows.forEach(row => {
                        const rowJurusan = row.getAttribute('data-jurusan');
                        row.style.display = (filter === 'all' || rowJurusan === filter) ?
                            'table-row' : 'none';
                    });
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* View Toggle Buttons */
        .view-toggle-btn {
            color: #6b7280;
            background: transparent;
        }

        .view-toggle-btn.active {
            color: #1e40af;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .guru-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for grid */
        .guru-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .guru-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .guru-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .guru-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .guru-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .guru-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        .guru-card:nth-child(7) {
            animation-delay: 0.7s;
        }

        .guru-card:nth-child(8) {
            animation-delay: 0.8s;
        }
    </style>
@endpush
