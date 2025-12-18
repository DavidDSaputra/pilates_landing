@extends('layoutsadmin.app')
@section('title', 'Daftar Artikel')
@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 animate-fade-in-up">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-blue-400">Artikel</h2>
                    <p class="text-sm theme-text-secondary mt-1">Kelola artikel dan konten website</p>
                </div>
                <a href="{{ route('admin.artikels.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white font-medium rounded-lg transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Artikel</span>
                </a>
            </div>
        </div>

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
            <form method="GET" action="{{ route('admin.artikels.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-semibold theme-text-secondary mb-2">
                            <i class="fas fa-search mr-1 opacity-70"></i>Pencarian
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul, konten..."
                            class="w-full px-4 py-2.5 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
                    </div>

                    <!-- Penulis Filter -->
                    <div>
                        <label for="penulis" class="block text-sm font-semibold theme-text-secondary mb-2">
                            <i class="fas fa-user mr-1 opacity-70"></i>Penulis
                        </label>
                        <select id="penulis" name="penulis"
                            class="w-full px-4 py-2.5 theme-bg-secondary theme-border border rounded-lg focus:outline-none focus:border-blue-400 transition theme-text-primary">
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
                        class="inline-flex items-center px-6 py-2.5 bg-gradient-primary hover:shadow-lg hover:shadow-blue-500/30 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.artikels.index') }}"
                        class="inline-flex items-center px-6 py-2.5 theme-bg-secondary theme-border border hover:border-blue-400 theme-text-primary font-medium rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Reset Filter
                    </a>
                </div>

                <!-- Active Filters Display -->
                @if (request()->hasAny(['search', 'penulis']))
                    <div class="flex flex-wrap gap-2 pt-4 theme-border border-t border-dashed mt-4">
                        <span class="text-sm font-medium theme-text-secondary">Filter Aktif:</span>
                        @if (request('search'))
                            <span
                                class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm font-medium border border-blue-500/20">
                                <i class="fas fa-search mr-1"></i>{{ request('search') }}
                            </span>
                        @endif
                        @if (request('penulis'))
                            <span
                                class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-sm font-medium border border-blue-500/20">
                                <i class="fas fa-user mr-1"></i>{{ $penulis->find(request('penulis'))->nama_lengkap ?? 'Unknown' }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Articles Table -->
        <div
            class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl shadow-2xl overflow-hidden animate-fade-in-up delay-200">
            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y theme-divide">
                    <thead class="theme-bg-secondary">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Artikel
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Penulis
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Views
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold theme-text-primary uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y theme-divide">
                        @forelse($artikels as $artikel)
                            <tr class="hover:bg-blue-400/5 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($artikel->gambar_featured)
                                            <img class="h-12 w-12 rounded-lg object-cover mr-3 theme-border border ring-2 ring-blue-400/30"
                                                src="{{ Storage::url($artikel->gambar_featured) }}" alt="">
                                        @else
                                            <div
                                                class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 mr-3 flex items-center justify-center">
                                                <i class="fas fa-image text-white"></i>
                                            </div>
                                        @endif
                                        <div class="max-w-xs">
                                            <div class="text-sm font-semibold theme-text-primary line-clamp-2">
                                                {{ $artikel->judul }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm theme-text-secondary">{{ $artikel->penulis->nama_lengkap ?? 'Unknown' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm theme-text-secondary">
                                        <i class="fas fa-eye opacity-70 mr-2"></i>
                                        {{ number_format($artikel->views ?? 0) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-secondary">
                                    <i class="far fa-calendar mr-1 opacity-70"></i>
                                    {{ $artikel->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.artikels.show', $artikel->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-500/10 hover:bg-green-500/20 text-green-500 rounded-lg transition duration-150"
                                            title="Lihat">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.artikels.edit', $artikel->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition duration-150"
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
                                        <i class="fas fa-newspaper text-5xl theme-text-secondary mb-4 opacity-20"></i>
                                        <p class="theme-text-secondary font-medium">Belum ada artikel</p>
                                        @if (request()->hasAny(['search', 'penulis']))
                                            <a href="{{ route('admin.artikels.index') }}"
                                                class="mt-2 text-blue-400 hover:text-blue-300 text-sm">
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
            <div class="md:hidden divide-y theme-divide">
                @forelse($artikels as $artikel)
                    <div class="p-4 hover:bg-blue-400/5 transition duration-150">
                        <div class="flex gap-4">
                            @if ($artikel->gambar_featured)
                                <img class="h-20 w-20 rounded-lg object-cover theme-border border ring-2 ring-blue-400/30 flex-shrink-0"
                                    src="{{ Storage::url($artikel->gambar_featured) }}" alt="">
                            @else
                                <div
                                    class="h-20 w-20 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-image text-white text-2xl"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold theme-text-primary line-clamp-2 mb-2">{{ $artikel->judul }}
                                </h3>
                                <div class="flex items-center gap-4 text-xs theme-text-secondary mb-3">
                                    <span><i
                                            class="fas fa-user mr-1"></i>{{ $artikel->penulis->nama_lengkap ?? 'Unknown' }}</span>
                                    <span><i class="fas fa-eye mr-1"></i>{{ number_format($artikel->views ?? 0) }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.artikels.show', $artikel->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-500/10 hover:bg-green-500/20 text-green-500 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-eye mr-2"></i>Lihat
                                    </a>
                                    <a href="{{ route('admin.artikels.edit', $artikel->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-500 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-newspaper text-5xl theme-text-secondary mb-4 opacity-20"></i>
                        <p class="theme-text-secondary font-medium">Belum ada artikel</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($artikels->hasPages())
                <div class="px-6 py-4 theme-bg-secondary theme-border border-t">
                    {{ $artikels->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection