@extends('admin.layouts.app')

@section('title', 'Kelola Pengaduan')
@section('page-title', 'Kelola Pengaduan')
@section('page-subtitle', 'Kelola pengaduan dari masyarakat')

@section('content')
    <!-- Statistics Cards -->
    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
        <!-- Total Pengaduan -->
        <div class="rounded-xl border-l-4 border-blue-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Total Pengaduan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pengaduans->total() }}</p>
                    <p class="mt-2 text-xs text-blue-600">
                        <i class="fas fa-comments"></i> Semua pengaduan
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100">
                    <i class="fas fa-comments text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Pengaduan Hari Ini -->
        <div class="rounded-xl border-l-4 border-green-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ \App\Models\Pengaduan::whereDate('tanggal_kirim', today())->count() }}
                    </p>
                    <p class="mt-2 text-xs text-green-600">
                        <i class="fas fa-calendar-day"></i> Pengaduan baru
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100">
                    <i class="fas fa-clock text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Bulan Ini -->
        <div class="rounded-xl border-l-4 border-purple-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ \App\Models\Pengaduan::whereMonth('tanggal_kirim', now()->month)->whereYear('tanggal_kirim', now()->year)->count() }}
                    </p>
                    <p class="mt-2 text-xs text-purple-600">
                        <i class="fas fa-calendar-alt"></i> {{ now()->format('F Y') }}
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-purple-100">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl bg-white shadow-sm">
        <!-- Card Header -->
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-list mr-2 text-blue-600"></i>
                    Daftar Pengaduan
                </h3>
                <div class="text-sm text-gray-500">
                    Total: <span class="font-semibold text-gray-800">{{ $pengaduans->total() }}</span> pengaduan
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            @if ($pengaduans->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                <th class="px-4 py-3 text-center">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Pesan</th>
                                <th class="px-4 py-3 text-center">Tanggal</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($pengaduans as $pengaduan)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-4 py-4 text-center text-sm text-gray-600">
                                        {{ ($pengaduans->currentPage() - 1) * $pengaduans->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100">
                                                <i class="fas fa-user text-blue-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="font-semibold text-gray-800">{{ $pengaduan->nama }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        @if ($pengaduan->email)
                                            <a href="mailto:{{ $pengaduan->email }}"
                                                class="flex items-center text-blue-600 transition hover:text-blue-800">
                                                <i class="fas fa-envelope mr-2"></i>
                                                <span class="truncate">{{ $pengaduan->email }}</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="line-clamp-2 text-sm text-gray-600" title="{{ $pengaduan->pesan }}">
                                            {{ Str::limit($pengaduan->pesan, 100) }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4 text-center text-sm text-gray-600">
                                        <div class="flex flex-col items-center">
                                            <span
                                                class="font-medium">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kirim)->format('d M Y') }}</span>
                                            <span
                                                class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kirim)->format('H:i') }}
                                                WIB</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Button Detail -->
                                            <button onclick="openModal('modal{{ $pengaduan->id }}')"
                                                class="rounded-lg bg-blue-500 px-3 py-2 text-sm text-white transition hover:bg-blue-600"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Button Hapus -->
                                            <form action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan dari {{ $pengaduan->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-lg bg-red-500 px-3 py-2 text-sm text-white transition hover:bg-red-600"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Detail -->
                                <tr id="modal{{ $pengaduan->id }}" class="modal-row hidden">
                                    <td colspan="6" class="p-0">
                                        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
                                            onclick="closeModal('modal{{ $pengaduan->id }}', event)">
                                            <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl bg-white shadow-2xl"
                                                onclick="event.stopPropagation()">
                                                <!-- Modal Header -->
                                                <div
                                                    class="border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                                    <div class="flex items-center justify-between">
                                                        <h3 class="text-xl font-semibold text-white">
                                                            <i class="fas fa-file-alt mr-2"></i>
                                                            Detail Pengaduan
                                                        </h3>
                                                        <button onclick="closeModal('modal{{ $pengaduan->id }}')"
                                                            class="text-white transition hover:text-gray-200">
                                                            <i class="fas fa-times text-2xl"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="p-6">
                                                    <!-- Info Grid -->
                                                    <div class="mb-6 grid gap-4 md:grid-cols-2">
                                                        <div class="rounded-lg bg-gray-50 p-4">
                                                            <p
                                                                class="mb-2 flex items-center text-sm font-semibold text-gray-600">
                                                                <i class="fas fa-user mr-2 text-blue-600"></i>
                                                                Nama Pengirim
                                                            </p>
                                                            <p class="text-gray-800">{{ $pengaduan->nama }}</p>
                                                        </div>

                                                        <div class="rounded-lg bg-gray-50 p-4">
                                                            <p
                                                                class="mb-2 flex items-center text-sm font-semibold text-gray-600">
                                                                <i class="fas fa-envelope mr-2 text-blue-600"></i>
                                                                Email
                                                            </p>
                                                            @if ($pengaduan->email)
                                                                <a href="mailto:{{ $pengaduan->email }}"
                                                                    class="text-blue-600 hover:underline">
                                                                    {{ $pengaduan->email }}
                                                                </a>
                                                            @else
                                                                <span class="text-gray-400">Tidak ada</span>
                                                            @endif
                                                        </div>

                                                        <div class="rounded-lg bg-gray-50 p-4 md:col-span-2">
                                                            <p
                                                                class="mb-2 flex items-center text-sm font-semibold text-gray-600">
                                                                <i class="fas fa-calendar mr-2 text-blue-600"></i>
                                                                Tanggal & Waktu
                                                            </p>
                                                            <p class="text-gray-800">
                                                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_kirim)->isoFormat('dddd, D MMMM Y - HH:mm') }}
                                                                WIB
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Isi Pengaduan -->
                                                    <div>
                                                        <p class="mb-3 flex items-center font-semibold text-gray-700">
                                                            <i class="fas fa-comment-alt mr-2 text-blue-600"></i>
                                                            Isi Pengaduan
                                                        </p>
                                                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                                            <p class="whitespace-pre-line text-gray-700">
                                                                {{ $pengaduan->pesan }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                                                    <div class="flex items-center justify-end gap-3">
                                                        <button onclick="closeModal('modal{{ $pengaduan->id }}')"
                                                            class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 transition hover:bg-gray-100">
                                                            <i class="fas fa-times mr-2"></i>
                                                            Tutup
                                                        </button>
                                                        @if ($pengaduan->email)
                                                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $pengaduan->email }}&su=Re: Pengaduan Anda - {{ rawurlencode($pengaduan->nama) }}"
                                                                class="rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700"
                                                                target="_blank" rel="noopener noreferrer">
                                                                <i class="fas fa-reply mr-2"></i>
                                                                Balas via Email
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan
                        <span class="font-semibold">{{ $pengaduans->firstItem() }}</span>
                        sampai
                        <span class="font-semibold">{{ $pengaduans->lastItem() }}</span>
                        dari
                        <span class="font-semibold">{{ $pengaduans->total() }}</span>
                        pengaduan
                    </div>
                    <div>
                        {{ $pengaduans->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="py-16 text-center">
                    <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
                        <i class="fas fa-inbox text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">Belum Ada Pengaduan</h3>
                    <p class="text-gray-500">Pengaduan dari masyarakat akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .modal-row.hidden {
            display: none;
        }

        .modal-row:not(.hidden) {
            display: table-row;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId, event) {
            // Jika event undefined, berarti dipanggil dari tombol close
            if (!event || event.target === event.currentTarget) {
                document.getElementById(modalId).classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('.modal-row:not(.hidden)');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                });
            }
        });
    </script>
@endpush
