@extends('layoutsadmin.app')
@section('title', 'Daftar Produk')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 animate-fade-in-up">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-blue-400">Produk</h2>
                    <p class="text-sm theme-text-secondary mt-1">Kelola produk dan inventori</p>
                </div>
                <a href="{{ route('admin.produk.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white font-medium rounded-lg transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/50 rounded-lg p-4 shadow-sm animate-fade-in-up">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-500 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div
            class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-lg p-6 mb-6 animate-fade-in-up delay-100">
            <form method="GET" action="{{ route('admin.produk.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-semibold theme-text-secondary mb-2">
                            <i class="fas fa-search mr-1 opacity-70"></i>Pencarian
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama produk, deskripsi..."
                            class="w-full px-4 py-2.5 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                    </div>


                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.produk.index') }}"
                        class="inline-flex items-center px-6 py-2.5 theme-bg-secondary theme-border border hover:border-blue-400 theme-text-primary font-medium rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Reset Filter
                    </a>
                </div>

                <!-- Active Filters Display -->
                @if (request()->hasAny(['search']))
                    <div class="flex flex-wrap gap-2 pt-4 theme-border border-t border-dashed mt-4">
                        <span class="text-sm font-medium theme-text-secondary">Filter Aktif:</span>
                        @if (request('search'))
                            <span
                                class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm font-medium border border-blue-500/20">
                                <i class="fas fa-search mr-1"></i>{{ request('search') }}
                            </span>
                        @endif

                    </div>
                @endif
            </form>
        </div>

        <!-- Products Table/Cards -->
        <div
            class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-2xl overflow-hidden animate-fade-in-up delay-200">
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y theme-divide">
                    <thead class="theme-bg-secondary">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                No
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Produk
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Galeri
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y theme-divide">
                        @forelse($produk as $item)
                            <tr class="hover:bg-blue-400/5 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-secondary">
                                    {{ $loop->iteration + ($produk->currentPage() - 1) * $produk->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($item->gambar_utama)
                                            <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_produk }}"
                                                class="h-16 w-16 object-cover rounded-lg theme-border border ring-2 ring-blue-400/30 mr-3">
                                        @else
                                            <div
                                                class="h-16 w-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-box text-white text-xl"></i>
                                            </div>
                                        @endif
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold theme-text-primary">{{ $item->nama_produk }}</div>
                                            <div class="text-xs theme-text-secondary">{{ Str::limit($item->slug, 30) }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->gambar->count() > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            <i class="fas fa-images mr-1"></i>
                                            {{ $item->gambar->count() }}
                                        </span>
                                    @else
                                        <span class="theme-text-secondary text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.produk.show', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-500/10 hover:bg-green-500/20 text-green-500 rounded-lg transition duration-150"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.produk.edit', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition duration-150"
                                            title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        @if (auth()->user()->role === 'super_admin')
                                            <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus produk ini beserta semua gambarnya?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition duration-150"
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
                                        <i class="fas fa-box-open text-5xl theme-text-secondary mb-4 opacity-20"></i>
                                        <p class="theme-text-secondary font-medium">Tidak ada produk</p>
                                        @if (request()->hasAny(['search']))
                                            <a href="{{ route('admin.produk.index') }}"
                                                class="mt-2 text-blue-400 hover:text-blue-300 text-sm">
                                                Reset filter untuk melihat semua produk
                                            </a>
                                        @else
                                            <a href="{{ route('admin.produk.create') }}"
                                                class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-primary hover:shadow-lg text-white rounded-lg transition">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Produk Pertama
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden divide-y theme-divide">
                @forelse($produk as $item)
                    <div class="p-4 hover:bg-blue-400/5 transition duration-150">
                        <div class="flex gap-4">
                            @if ($item->gambar_utama)
                                <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_produk }}"
                                    class="h-20 w-20 object-cover rounded-lg theme-border border ring-2 ring-blue-400/30 flex-shrink-0">
                            @else
                                <div
                                    class="h-20 w-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-box text-white text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold theme-text-primary mb-1">{{ $item->nama_produk }}</h3>
                                <div class="flex items-center gap-2 mb-2">

                                    @if ($item->gambar->count() > 0)
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            <i class="fas fa-images mr-1"></i>{{ $item->gambar->count() }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.produk.show', $item->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-500/10 hover:bg-green-500/20 text-green-500 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-eye mr-2"></i>Lihat
                                    </a>
                                    <a href="{{ route('admin.produk.edit', $item->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-box-open text-5xl theme-text-secondary mb-4 opacity-20"></i>
                        <p class="theme-text-secondary font-medium">Tidak ada produk</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($produk->hasPages())
                <div class="px-6 py-4 theme-bg-secondary theme-border border-t">
                    {{ $produk->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection