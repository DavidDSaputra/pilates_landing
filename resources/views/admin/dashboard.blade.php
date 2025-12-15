@extends('layoutsadmin.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600">Selamat datang di panel admin</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Users -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_users']) }}</p>
                        <p class="text-xs text-gray-500 mt-2">Admin: {{ $stats['admin_users'] }} | Penulis:
                            {{ $stats['penulis_users'] }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-4">
                        <i class="fas fa-users text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Produk</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_products']) }}</p>
                        <p class="text-xs text-gray-500 mt-2">{{ $stats['total_categories'] }} Kategori</p>
                    </div>
                    <div class="bg-amber-100 rounded-full p-4">
                        <i class="fas fa-box text-amber-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Articles -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Artikel</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_articles']) }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4">
                        <i class="fas fa-newspaper text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Gallery Images -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Gambar Galeri</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_gallery_images']) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-2">Total gambar produk</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-4">
                        <i class="fas fa-images text-purple-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Articles -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Artikel Terbaru</h2>
                    <a href="{{ route('admin.artikels.index') }}" class="text-sm text-amber-600 hover:text-amber-700">Lihat
                        Semua</a>
                </div>
                <div class="p-6">
                    @forelse($recent_articles as $article)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-800">{{ Str::limit($article->judul, 40) }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $article->penulis->nama_lengkap ?? 'Unknown' }} •
                                    {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div>
                                @if($article->published_at)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Published</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada artikel</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Products -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Produk Terbaru</h2>
                    <a href="{{ route('admin.produk.index') }}" class="text-sm text-amber-600 hover:text-amber-700">Lihat
                        Semua</a>
                </div>
                <div class="p-6">
                    @forelse($recent_products as $product)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center flex-1">
                                @if($product->gambar_utama)
                                    <img src="{{ asset('storage/' . $product->gambar_utama) }}" alt="{{ $product->nama_produk }}"
                                        class="w-10 h-10 rounded object-cover mr-3">
                                @else
                                    <div class="w-10 h-10 rounded bg-gray-200 mr-3 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-sm font-medium text-gray-800">{{ Str::limit($product->nama_produk, 30) }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">{{ $product->kategori->nama_kategori ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $product->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada produk</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Bottom Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Popular Articles -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Artikel Populer</h2>
                </div>
                <div class="p-6">
                    @forelse($popular_articles as $article)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-800">{{ Str::limit($article->judul, 40) }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-eye"></i> {{ number_format($article->views) }} views
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>

            <!-- Products by Category -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Produk per Kategori</h2>
                </div>
                <div class="p-6">
                    @forelse($products_by_category as $category)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-800">{{ $category->nama_kategori }}</h3>
                            </div>
                            <div>
                                <span class="px-3 py-1 text-sm rounded-full bg-amber-100 text-amber-800 font-medium">
                                    {{ $category->produk_count }} produk
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada kategori</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity Log -->
        <div class="bg-white rounded-lg shadow-md mt-6">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
                <a href="{{ route('admin.activity-logs.index') }}" class="text-sm text-amber-600 hover:text-amber-700">Lihat
                    Semua</a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($recent_activities as $activity)
                        <div class="flex items-start py-2 border-b border-gray-100 last:border-0">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">{{ $activity->user->nama_lengkap ?? 'System' }}</span>
                                    <span class="text-gray-600">{{ $activity->action }}</span>
                                    <span class="font-medium">{{ $activity->model_type }}</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection