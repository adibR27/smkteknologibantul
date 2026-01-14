@extends('admin.layouts.app')

@section('title', 'Manajemen Admin')
@section('page-title', 'Manajemen Admin')
@section('page-subtitle', 'Kelola akun administrator sistem')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <!-- Header -->
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Administrator</h2>
                <p class="mt-1 text-sm text-gray-500">Total: {{ $admins->total() }} admin terdaftar</p>
            </div>
            <a href="{{ route('admin.admin-management.create') }}"
                class="inline-flex items-center space-x-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700">
                <i class="fas fa-plus"></i>
                <span>Tambah Admin Baru</span>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Avatar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Username</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Terdaftar</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($admins as $index => $admin)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-600">
                                {{ $admins->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-sm font-bold text-white">
                                    {{ strtoupper(substr($admin->nama_lengkap, 0, 1)) }}
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="font-semibold text-gray-800">{{ $admin->nama_lengkap }}</span>
                                    @if ($admin->id == auth()->guard('admin')->id())
                                        <span
                                            class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800">
                                            Anda
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <i class="fas fa-user mr-1 text-gray-400"></i>{{ $admin->username }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <i class="fas fa-envelope mr-1 text-gray-400"></i>{{ $admin->email }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                <i class="fas fa-calendar mr-1 text-gray-400"></i>
                                {{ $admin->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.admin-management.show', $admin->id) }}"
                                        class="rounded-lg bg-blue-100 p-2 text-blue-600 transition hover:bg-blue-200"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.admin-management.edit', $admin->id) }}"
                                        class="rounded-lg bg-yellow-100 p-2 text-yellow-600 transition hover:bg-yellow-200"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if ($admin->id != auth()->guard('admin')->id())
                                        <button onclick="confirmDelete({{ $admin->id }})"
                                            class="rounded-lg bg-red-100 p-2 text-red-600 transition hover:bg-red-200"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <button disabled class="cursor-not-allowed rounded-lg bg-gray-100 p-2 text-gray-400"
                                            title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-users mb-3 text-4xl text-gray-300"></i>
                                    <p class="text-gray-500">Belum ada data admin</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($admins->hasPages())
            <div class="mt-6">
                {{ $admins->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/admin-management/${id}`;
                form.submit();
            }
        }
    </script>
@endpush
