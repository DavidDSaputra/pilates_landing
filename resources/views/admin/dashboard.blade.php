@extends('layoutsadmin.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Total Users -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 card-hover animate-fade-in-up">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-400 rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <!-- Optional: Percentage change if available -->
            </div>
            <h3 class="theme-text-secondary text-sm mb-1">Total Pengguna</h3>
            <p class="text-3xl font-bold text-blue-400">{{ number_format($stats['total_users']) }}</p>
            <div class="mt-4 w-full theme-bg-secondary rounded-full h-2">
                <div class="bg-gradient-primary h-2 rounded-full shimmer" style="width: 70%"></div>
            </div>
             <p class="text-xs theme-text-secondary mt-2">Admin: {{ $stats['admin_users'] }} | Penulis: {{ $stats['penulis_users'] }}</p>
        </div>

        <!-- Total Products -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 card-hover animate-fade-in-up delay-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-box text-white text-xl"></i>
                </div>
            </div>
            <h3 class="theme-text-secondary text-sm mb-1">Total Produk</h3>
            <p class="text-3xl font-bold text-blue-400">{{ number_format($stats['total_products']) }}</p>
            <div class="mt-4 w-full theme-bg-secondary rounded-full h-2">
                <div class="bg-gradient-primary h-2 rounded-full shimmer" style="width: 85%"></div>
            </div>
        </div>

        <!-- Total Articles -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 card-hover animate-fade-in-up delay-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-newspaper text-white text-xl"></i>
                </div>
            </div>
            <h3 class="theme-text-secondary text-sm mb-1">Total Artikel</h3>
            <p class="text-3xl font-bold text-blue-400">{{ number_format($stats['total_articles']) }}</p>
             <div class="mt-4 w-full theme-bg-secondary rounded-full h-2">
                <div class="bg-gradient-primary h-2 rounded-full shimmer" style="width: 60%"></div>
            </div>
             <p class="text-xs theme-text-secondary mt-2">Published: {{ $stats['published_articles'] }}</p>
        </div>

        <!-- Total Gallery -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 card-hover animate-fade-in-up delay-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-400 rounded-lg flex items-center justify-center animate-float">
                    <i class="fas fa-images text-white text-xl"></i>
                </div>
            </div>
            <h3 class="theme-text-secondary text-sm mb-1">Gambar Galeri</h3>
            <p class="text-3xl font-bold text-blue-400">{{ number_format($stats['total_gallery_images']) }}</p>
            <div class="mt-4 w-full theme-bg-secondary rounded-full h-2">
                <div class="bg-gradient-primary h-2 rounded-full shimmer" style="width: 90%"></div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Articles -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 animate-fade-in-up delay-400">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-blue-400">Artikel Terbaru</h2>
                <a href="{{ route('admin.artikels.index') }}" class="text-sm theme-text-secondary hover:text-blue-400 transition-colors">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recent_articles as $article)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-400/10 transition-all duration-300 theme-border border-b last:border-0 border-dashed">
                        <div class="flex-1 min-w-0 mr-4">
                            <h3 class="text-sm font-medium theme-text-primary truncate">{{ $article->judul }}</h3>
                             <p class="text-xs theme-text-secondary mt-1">
                                {{ $article->penulis->nama_lengkap ?? 'Unknown' }} • {{ $article->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div>
                             @if($article->published_at)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-400">Published</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-400">Draft</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center theme-text-secondary py-4">Belum ada artikel</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 animate-fade-in-up delay-500">
             <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-blue-400">Produk Terbaru</h2>
                <a href="{{ route('admin.produk.index') }}" class="text-sm theme-text-secondary hover:text-blue-400 transition-colors">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recent_products as $product)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-400/10 transition-all duration-300 theme-border border-b last:border-0 border-dashed">
                        <div class="flex items-center flex-1 min-w-0">
                            @if($product->gambar_utama)
                                <img src="{{ asset('storage/' . $product->gambar_utama) }}" alt="{{ $product->nama_produk }}"
                                    class="w-10 h-10 rounded object-cover mr-3 theme-border border">
                            @else
                                <div class="w-10 h-10 rounded theme-bg-secondary mr-3 flex items-center justify-center theme-border border">
                                    <i class="fas fa-image theme-text-secondary"></i>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <h3 class="text-sm font-medium theme-text-primary truncate">{{ $product->nama_produk }}</h3>

                            </div>
                        </div>
                         <div class="text-xs theme-text-secondary ml-2 whitespace-nowrap">
                            {{ $product->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                     <p class="text-center theme-text-secondary py-4">Belum ada produk</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Bottom Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Popular Articles -->
         <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 animate-fade-in-up delay-600">
             <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-blue-400">Artikel Populer</h2>
            </div>
            <div class="space-y-4">
                 @forelse($popular_articles as $article)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-400/10 transition-all duration-300 theme-border border-b last:border-0 border-dashed">
                         <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-medium theme-text-primary truncate">{{ $article->judul }}</h3>
                            </div>
                            <div class="flex items-center text-xs theme-text-secondary ml-4">
                                <i class="fas fa-eye mr-1"></i> {{ number_format($article->views) }}
                            </div>
                    </div>
                @empty
                     <p class="text-center theme-text-secondary py-4">Belum ada data</p>
                @endforelse
            </div>
        </div>

      </div>

    <!-- Recent Activity Log -->
    <div class="bg-gradient-card backdrop-blur-sm theme-border border rounded-xl p-6 animate-fade-in-up delay-700">
         <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-blue-400">Aktivitas Terbaru</h2>
            <a href="{{ route('admin.activity-logs.index') }}" class="text-sm theme-text-secondary hover:text-blue-400 transition-colors">Lihat Semua</a>
        </div>
        <div class="space-y-4">
             @forelse($recent_activities as $activity)
                <div class="flex items-start p-3 rounded-lg hover:bg-blue-400/10 transition-all duration-300 theme-border border-b last:border-0 border-dashed">
                     <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-400/20 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-400 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                         <p class="text-sm theme-text-primary">
                            <span class="font-medium text-blue-400">{{ $activity->user->nama_lengkap ?? 'System' }}</span>
                            <span class="theme-text-secondary">{{ $activity->action }}</span>
                            <span class="font-medium text-blue-400">{{ $activity->model_type }}</span>
                        </p>
                        <p class="text-xs theme-text-secondary mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
             @empty
                 <p class="text-center theme-text-secondary py-4">Belum ada aktivitas</p>
             @endforelse
        </div>
    </div>
@endsection