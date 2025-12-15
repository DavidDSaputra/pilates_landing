@extends('layoutsadmin.app')

@section('title', 'Daftar Artikel')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Artikel</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola artikel dan konten website</p>
                </div>
                <a href="{{ route('admin.artikels.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Artikel</span>
                </a>
            </div>
        </div>

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
            <form method="GET" action="{{ route('admin.artikels.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-search mr-1 text-gray-400"></i>Pencarian
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul, konten..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    </div>

                    <!-- Penulis Filter -->
                    <div>
                        <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-1 text-gray-400"></i>Penulis
                        </label>
                        <select id="penulis" name="penulis"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">Semua Penulis</option>
                            @foreach ($penulis as $p)
                                <option value="{{ $p->id }}" {{ request('penulis') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_lengkap }}
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
                    <a href="{{ route('admin.artikels.index') }}"
                        class="inline-flex items-center px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Reset Filter
                    </a>
                </div>

                <!-- Active Filters Display -->
                @if (request()->hasAny(['search', 'penulis']))
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-600">Filter Aktif:</span>
                        @if (request('search'))
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                <i class="fas fa-search mr-1"></i>{{ request('search') }}
                            </span>
                        @endif
                        @if (request('penulis'))
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                <i class="fas fa-user mr-1"></i>{{ $penulis->find(request('penulis'))->nama_lengkap ?? 'Unknown' }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Articles Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-amber-50 to-amber-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Artikel
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Penulis
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Views
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-amber-900 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($artikels as $artikel)
                            <tr class="hover:bg-amber-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($artikel->gambar_featured)
                                            <img class="h-12 w-12 rounded-lg object-cover mr-3 ring-2 ring-amber-200"
                                                src="{{ Storage::url($artikel->gambar_featured) }}" alt="">
                                        @else
                                            <div
                                                class="h-12 w-12 rounded-lg bg-gradient-to-br from-amber-200 to-amber-300 mr-3 flex items-center justify-center">
                                                <i class="fas fa-image text-amber-700"></i>
                                            </div>
                                        @endif
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold text-gray-900 line-clamp-2">
                                                {{ $artikel->judul }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $artikel->penulis->nama_lengkap ?? 'Unknown' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-eye text-gray-400 mr-2"></i>
                                        {{ number_format($artikel->views ?? 0) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <i class="far fa-calendar mr-1 text-gray-400"></i>
                                    {{ $artikel->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.artikels.show', $artikel->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition duration-150"
                                            title="Lihat">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.artikels.edit', $artikel->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition duration-150"
                                            title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        @if (auth()->user()->role === 'super_admin')
                                            <form action="{{ route('admin.artikels.destroy', $artikel->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
                                        <i class="fas fa-newspaper text-5xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500 font-medium">Belum ada artikel</p>
                                        @if (request()->hasAny(['search', 'penulis']))
                                            <a href="{{ route('admin.artikels.index') }}"
                                                class="mt-2 text-amber-600 hover:text-amber-700 text-sm">
                                                Reset filter untuk melihat semua artikel
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
            <div class="md:hidden divide-y divide-gray-200">
                @forelse($artikels as $artikel)
                    <div class="p-4 hover:bg-amber-50 transition duration-150">
                        <div class="flex gap-4">
                            @if ($artikel->gambar_featured)
                                <img class="h-20 w-20 rounded-lg object-cover ring-2 ring-amber-200 flex-shrink-0"
                                    src="{{ Storage::url($artikel->gambar_featured) }}" alt="">
                            @else
                                <div
                                    class="h-20 w-20 rounded-lg bg-gradient-to-br from-amber-200 to-amber-300 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-image text-amber-700 text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 line-clamp-2 mb-2">{{ $artikel->judul }}
                                </h3>
                                <div class="flex items-center gap-4 text-xs text-gray-600 mb-3">
                                    <span><i
                                            class="fas fa-user mr-1"></i>{{ $artikel->penulis->nama_lengkap ?? 'Unknown' }}</span>
                                    <span><i class="fas fa-eye mr-1"></i>{{ number_format($artikel->views ?? 0) }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.artikels.show', $artikel->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-eye mr-2"></i>Lihat
                                    </a>
                                    <a href="{{ route('admin.artikels.edit', $artikel->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-newspaper text-5xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 font-medium">Belum ada artikel</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($artikels->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $artikels->links() }}
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