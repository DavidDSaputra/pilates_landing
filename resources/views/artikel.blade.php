<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Artikel Pilates | Tips & Panduan Studio Pilates</title>
    <meta name="description"
        content="Artikel, tips, dan panduan lengkap tentang Pilates, peralatan studio, dan bisnis Pilates di Indonesia.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <x-navbar />

    <!-- Theme Toggle Button -->
    <button id="theme-toggle"
        class="fixed top-6 right-6 z-50 p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border"
        style="background-color: var(--bg-secondary); border-color: var(--border-color);" aria-label="Toggle theme">
    </button>

    <!-- Article Page Content -->
    <div class="min-h-screen py-24 px-6" style="background-color: var(--bg-primary);">
        <div class="max-w-6xl mx-auto">

            <!-- Page Header -->
            <div class="text-center mb-16 fade-in-up">
                <h1 class="text-5xl md:text-6xl font-bold mb-4" style="color: var(--text-primary);">
                    Artikel & Panduan Pilates
                </h1>
                <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-secondary);">
                    Tips, panduan, dan informasi terkini seputar Pilates dan bisnis studio
                </p>
            </div>

            <!-- Articles Grid -->
                @forelse($artikels as $article)
                    <article
                        class="rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 border group stagger-item flex flex-col h-full"
                        style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                        
                        @if($article->gambar_featured)
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ asset('storage/' . $article->gambar_featured) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        @else
                        {{-- Fallback image or pattern could go here --}}
                        <div class="aspect-video bg-gray-800 flex items-center justify-center">
                            <i class="fas fa-newspaper text-4xl text-gray-600"></i>
                        </div>
                        @endif

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                    style="background-color: var(--bg-tertiary); color: var(--accent-primary);">
                                    {{ is_array($article->tags) && count($article->tags) > 0 ? $article->tags[0] : 'Umum' }}
                                </span>
                                <span class="text-xs" style="color: var(--text-tertiary);">
                                    {{ $article->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold mb-3 group-hover:text-opacity-80 transition-opacity line-clamp-2"
                                style="color: var(--text-primary);">
                                {{ $article->judul }}
                            </h3>

                            <p class="text-sm leading-relaxed mb-4 flex-1 line-clamp-3" style="color: var(--text-secondary);">
                                {{ $article->excerpt }}
                            </p>

                            <a href="{{ route('artikel.detail', $article->slug) }}"
                                class="inline-flex items-center gap-2 text-sm font-semibold transition-all group-hover:gap-3 mt-auto"
                                style="color: var(--accent-primary);">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="inline-block p-4 rounded-full bg-gray-100 mb-4 dark:bg-gray-800">
                            <i class="far fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Belum ada artikel</h3>
                        <p style="color: var(--text-secondary);">Silakan kembali lagi nanti untuk update terbaru.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $artikels->links() }}

        </div>
    </div>

    <x-footer />
</body>

</html>