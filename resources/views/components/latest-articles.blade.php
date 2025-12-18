@props(['articles' => []])

<section class="py-24 px-6 border-t section-gradient"
    style="background-color: var(--bg-primary); border-color: var(--border-color);">
    <div class="max-w-7xl mx-auto">
        {{-- Section Header --}}
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-primary);">
                Artikel Terbaru
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-secondary);">
                Wawasan dan tips seputar dunia Pilates dan bisnis studio
            </p>
        </div>

        {{-- Articles Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-grid">
            @forelse($articles as $article)
                <article
                    class="rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 border group stagger-item flex flex-col h-full"
                    style="background-color: var(--bg-secondary); border-color: var(--border-color);">

                    {{-- Article Image --}}
                    @if($article->gambar)
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                    @endif

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                style="background-color: var(--bg-tertiary); color: var(--accent-primary);">
                                {{ $article->kategori }}
                            </span>
                            <span class="text-xs" style="color: var(--text-tertiary);">
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : $article->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold mb-3 group-hover:text-opacity-80 transition-opacity line-clamp-2"
                            style="color: var(--text-primary);">
                            {{ $article->judul }}
                        </h3>

                        <div class="text-sm leading-relaxed mb-4 line-clamp-3 flex-1" style="color: var(--text-secondary);">
                            {!! Str::limit(strip_tags($article->img_alt ?? $article->konten), 120) !!}
                        </div>

                        <a href="{{ route('artikels.show', $article->slug ?? '#') }}"
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
                <div class="col-span-3 text-center py-12">
                    <p class="text-lg text-gray-500">Belum ada artikel terbaru.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ url('/artikel') }}"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg border group"
                style="background-color: transparent; color: var(--text-primary); border-color: var(--border-color);">
                Lihat Semua Artikel
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</section>