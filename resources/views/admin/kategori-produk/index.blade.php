@extends('layoutsadmin.app')

@section('title', 'Kategori Produk')
@section('page-title', 'Manajemen Kategori Produk')

@section('content')
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kategori Produk</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola kategori dan klasifikasi produk</p>
            </div>
            <a href="{{ route('admin.kategori-produks.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Kategori</span>
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm animate-fade-in">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm animate-fade-in">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-amber-50 to-amber-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Urutan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Slug
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Jumlah Produk
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-amber-900 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kategoris as $kategori)
                        <tr class="hover:bg-amber-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-amber-100 text-amber-700 font-semibold text-sm">
                                    {{ $kategori->urutan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($kategori->gambar)
                                        <img class="h-12 w-12 rounded-full object-cover mr-3 ring-2 ring-amber-200"
                                            src="{{ Storage::url($kategori->gambar) }}" alt="">
                                    @else
                                        <div
                                            class="h-12 w-12 rounded-full bg-gradient-to-br from-amber-200 to-amber-300 mr-3 flex items-center justify-center">
                                            <i class="fas fa-box text-amber-700"></i>
                                        </div>
                                    @endif
                                    <div class="text-sm font-semibold text-gray-900">{{ $kategori->nama_kategori }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $kategori->slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-box mr-1"></i>{{ $kategori->produk_count }} Produk
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.kategori-produks.show', $kategori->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition duration-150"
                                        title="Lihat">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.kategori-produks.edit', $kategori->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition duration-150"
                                        title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    @if (auth()->user()->role === 'super_admin')
                                        <form action="{{ route('admin.kategori-produks.destroy', $kategori->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition duration-150"
                                                title="Hapus">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-tags text-5xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500 font-medium">Belum ada kategori produk</p>
                                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Kategori" untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($kategoris as $kategori)
                <div class="p-4 hover:bg-amber-50 transition duration-150">
                    <div class="flex items-start gap-4">
                        @if ($kategori->gambar)
                            <img class="h-16 w-16 rounded-full object-cover ring-2 ring-amber-200 flex-shrink-0"
                                src="{{ Storage::url($kategori->gambar) }}" alt="">
                        @else
                            <div
                                class="h-16 w-16 rounded-full bg-gradient-to-br from-amber-200 to-amber-300 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-box text-amber-700 text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-amber-100 text-amber-700 font-semibold text-xs">
                                    {{ $kategori->urutan }}
                                </span>
                                <h3 class="text-base font-semibold text-gray-900">{{ $kategori->nama_kategori }}</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $kategori->slug }}</p>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-box mr-1"></i>{{ $kategori->produk_count }} Produk
                            </span>
                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('admin.kategori-produks.show', $kategori->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition text-sm font-medium">
                                    <i class="fas fa-eye mr-2"></i>Lihat
                                </a>
                                <a href="{{ route('admin.kategori-produks.edit', $kategori->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <i class="fas fa-tags text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 font-medium">Belum ada kategori produk</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($kategoris->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
@endsection