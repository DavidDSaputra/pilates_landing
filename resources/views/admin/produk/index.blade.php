@extends('layoutsadmin.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Produk</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola produk dan inventori</p>
                </div>
                <a href="{{ route('admin.produk.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('admin.produk.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-search mr-1 text-gray-400"></i>Pencarian
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama produk, deskripsi..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    </div>

                    <!-- Kategori Filter -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tags mr-1 text-gray-400"></i>Kategori
                        </label>
                        <select id="kategori" name="kategori"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition duration-200 shadow-sm">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.produk.index') }}"
                        class="inline-flex items-center px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Reset Filter
                    </a>
                </div>

                <!-- Active Filters Display -->
                @if (request()->hasAny(['search', 'kategori']))
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600">Filter Aktif:</span>
                        @if (request('search'))
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                <i class="fas fa-search mr-1"></i>{{ request('search') }}
                            </span>
                        @endif
                        @if (request('kategori'))
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                <i
                                    class="fas fa-tags mr-1"></i>{{ $kategori->find(request('kategori'))->nama_kategori ?? 'Unknown' }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Products Table/Cards -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-amber-50 to-amber-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Produk
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Galeri
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($produk as $item)
                            <tr class="hover:bg-amber-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $loop->iteration + ($produk->currentPage() - 1) * $produk->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($item->gambar_utama)
                                            <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_produk }}"
                                                class="h-16 w-16 object-cover rounded-lg ring-2 ring-amber-200 mr-3">
                                        @else
                                            <div
                                                class="h-16 w-16 bg-gradient-to-br from-amber-200 to-amber-300 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-box text-amber-700 text-xl"></i>
                                            </div>
                                        @endif
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold text-gray-900">{{ $item->nama_produk }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($item->slug, 30) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->gambar->count() > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-images mr-1"></i>
                                            {{ $item->gambar->count() }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.produk.show', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition duration-150"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.produk.edit', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition duration-150"
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
                                        <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500 font-medium">Tidak ada produk</p>
                                        @if (request()->hasAny(['search', 'kategori']))
                                            <a href="{{ route('admin.produk.index') }}"
                                                class="mt-2 text-amber-600 hover:text-amber-700 text-sm">
                                                Reset filter untuk melihat semua produk
                                            </a>
                                        @else
                                            <a href="{{ route('admin.produk.create') }}"
                                                class="mt-4 inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition">
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
            <div class="lg:hidden divide-y divide-gray-200">
                @forelse($produk as $item)
                    <div class="p-4 hover:bg-amber-50 transition duration-150">
                        <div class="flex gap-4">
                            @if ($item->gambar_utama)
                                <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_produk }}"
                                    class="h-20 w-20 object-cover rounded-lg ring-2 ring-amber-200 flex-shrink-0">
                            @else
                                <div
                                    class="h-20 w-20 bg-gradient-to-br from-amber-200 to-amber-300 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-box text-amber-700 text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 mb-1">{{ $item->nama_produk }}</h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                    @if ($item->gambar->count() > 0)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <i class="fas fa-images mr-1"></i>{{ $item->gambar->count() }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.produk.show', $item->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-eye mr-2"></i>Lihat
                                    </a>
                                    <a href="{{ route('admin.produk.edit', $item->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 font-medium">Tidak ada produk</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($produk->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $produk->links() }}
                </div>
            @endif
        </div>
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