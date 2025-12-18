<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $artikel->meta_title ?? $artikel->judul }} | PilatesPro</title>
    <meta name="description"
        content="{{ $artikel->meta_description ?? Str::limit(strip_tags($artikel->konten), 160) }}">
    @if($artikel->meta_keywords)
        <meta name="keywords" content="{{ $artikel->meta_keywords }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .prose h2 {
            color: var(--text-primary);
            margin-top: 2em;
            margin-bottom: 1em;
            font-weight: 700;
            font-size: 1.5em;
        }

        .prose h3 {
            color: var(--text-primary);
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            font-weight: 600;
            font-size: 1.25em;
        }

        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
            color: var(--text-secondary);
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
            color: var(--text-secondary);
        }

        .prose ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
            color: var(--text-secondary);
        }

        .prose strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        .prose a {
            color: var(--accent-primary);
            text-decoration: underline;
        }

        .prose img {
            border-radius: 0.75rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .prose blockquote {
            border-left: 4px solid var(--accent-primary);
            padding-left: 1em;
            font-style: italic;
            margin-bottom: 1.25em;
            color: var(--text-primary);
        }
    </style>
</head>

<body class="antialiased font-sans" style="background-color: var(--bg-primary); color: var(--text-primary);">
    <x-navbar />

    <!-- Progress Bar -->
    <div class="fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 z-50 transition-all duration-300"
        id="progressBar" style="width: 0%"></div>

    <main class="pt-24 pb-16">
        <!-- Back Button -->
        <div class="max-w-4xl mx-auto px-6 mb-8">
            <a href="{{ route('artikels.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium transition-colors hover:text-blue-500"
                style="color: var(--text-secondary);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Artikel
            </a>
        </div>

        <article class="max-w-4xl mx-auto px-6">
            <!-- Article Header -->
            <header class="mb-10 text-center">
                <div class="flex items-center justify-center gap-2 mb-6">
                    @if(is_array($artikel->tags) && count($artikel->tags) > 0)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold"
                            style="background-color: var(--bg-tertiary); color: var(--accent-primary);">
                            {{ $artikel->tags[0] }}
                        </span>
                    @endif
                    <span class="text-sm" style="color: var(--text-tertiary);">
                        {{ $artikel->created_at->format('d M Y') }}
                    </span>
                    <span class="text-sm" style="color: var(--text-tertiary);">•</span>
                    <span class="text-sm" style="color: var(--text-tertiary);">
                        {{ $artikel->views }} Views
                    </span>
                </div>

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight"
                    style="color: var(--text-primary);">
                    {{ $artikel->judul }}
                </h1>

                <div class="flex items-center justify-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($artikel->penulis->name ?? 'Admin') }}&background=random"
                            alt="{{ $artikel->penulis->name ?? 'Admin' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-semibold" style="color: var(--text-primary);">
                            {{ $artikel->penulis->name ?? 'Admin' }}</p>
                        <p class="text-xs" style="color: var(--text-secondary);">Penulis</p>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($artikel->gambar_featured)
                <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl aspect-video">
                    <img src="{{ asset('storage/' . $artikel->gambar_featured) }}" alt="{{ $artikel->judul }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Content -->
            <div class="prose max-w-none text-lg">
                {!! $artikel->konten !!}
            </div>

            <!-- Tags -->
            @if(is_array($artikel->tags) && count($artikel->tags) > 0)
                <div class="mt-12 pt-8 border-t" style="border-color: var(--border-color);">
                    <h4 class="text-sm font-semibold mb-4" style="color: var(--text-primary);">Tags:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($artikel->tags as $tag)
                            <a href="#" class="px-4 py-2 rounded-lg text-sm transition-colors hover:opacity-80"
                                style="background-color: var(--bg-secondary); color: var(--text-secondary);">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </article>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <section class="mt-24 pt-16 border-t px-6" style="border-color: var(--border-color);">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl font-bold mb-10 text-center" style="color: var(--text-primary);">Artikel Terkait
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($relatedArticles as $related)
                            <article class="rounded-xl overflow-hidden border transition-transform hover:-translate-y-1"
                                style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                                @if($related->gambar_featured)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('storage/' . $related->gambar_featured) }}" alt="{{ $related->judul }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="aspect-video bg-gray-800 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-2xl text-gray-600"></i>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="font-bold text-lg mb-2 line-clamp-2" style="color: var(--text-primary);">
                                        <a href="{{ route('artikel.detail', $related->slug) }}"
                                            class="hover:text-blue-500 transition-colors">
                                            {{ $related->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-sm line-clamp-2 mb-4" style="color: var(--text-secondary);">
                                        {{ $related->excerpt }}
                                    </p>
                                    <span class="text-xs"
                                        style="color: var(--text-tertiary);">{{ $related->created_at->format('d M Y') }}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </main>

    <x-footer />

    <script>
        // Progress Bar logic
        window.onscroll = function () {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };
    </script>
</body>

</html>