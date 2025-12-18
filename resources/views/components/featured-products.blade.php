@props(['products' => []])

<section class="py-24 px-6 border-t section-gradient"
    style="background-color: var(--bg-primary); border-color: var(--border-color);">
    <div class="max-w-7xl mx-auto">
        {{-- Section Header --}}
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-primary);">
                Produk Kami
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-secondary);">
                Peralatan Pilates berkualitas tinggi untuk studio profesional Anda
            </p>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-grid">
            @forelse($products as $product)
                <div class="rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 border group stagger-item"
                    style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                    {{-- Product Image --}}
                    <div class="aspect-[4/3] overflow-hidden" style="background-color: var(--bg-tertiary);">
                        @if ($product->gambar_utama)
                            <img src="{{ asset('storage/' . $product->gambar_utama) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Product Content --}}
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4" style="color: var(--text-primary);">
                            {{ $product->nama_produk }}
                        </h3>

                        <div class="prose prose-sm mb-6 line-clamp-4" style="color: var(--text-secondary);">
                            {{-- Removing HTML tags for cleaner card view, or keeping basic formatting if needed --}}
                            {!! Str::limit(strip_tags($product->deskripsi_lengkap), 150) !!}
                        </div>

                        <a href="{{ route('produk.detail', $product->slug) }}"
                            class="block w-full text-center py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg border"
                            style="background-color: var(--bg-primary); color: var(--text-primary); border-color: var(--border-color);">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-lg text-gray-500">Belum ada produk.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>