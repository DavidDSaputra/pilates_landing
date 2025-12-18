<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $produk->meta_title ?? $produk->nama_produk }} | Pilates</title>
    <meta name="description"
        content="{{ $produk->meta_description ?? Str::limit(strip_tags($produk->deskripsi_lengkap), 160) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <x-navbar />

    <!-- Theme Toggle -->
    <button id="theme-toggle"
        class="fixed top-6 right-6 z-50 p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border"
        style="background-color: var(--bg-secondary); border-color: var(--border-color);" aria-label="Toggle theme">
    </button>

    <div class="min-h-screen py-24 px-6" style="background-color: var(--bg-primary);">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumbs / Back -->
            <div class="mb-8 animate-fade-in-up">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium transition-colors hover:text-opacity-80"
                    style="color: var(--text-secondary);">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <!-- Product Detail -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16 animate-fade-in-up delay-100">
                <!-- Images -->
                <div class="space-y-4">
                    <div class="rounded-2xl overflow-hidden border shadow-sm group relative"
                        style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                        @if($produk->gambar_utama)
                            <img src="{{ asset('storage/' . $produk->gambar_utama) }}" alt="{{ $produk->nama_produk }}"
                                class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>

                    @if($produk->gambar->count() > 0)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($produk->gambar as $gambar)
                                <a href="{{ asset('storage/' . $gambar->nama_file) }}" target="_blank"
                                    class="rounded-xl overflow-hidden border cursor-pointer hover:opacity-75 transition-opacity block"
                                    style="border-color: var(--border-color);">
                                    <img src="{{ asset('storage/' . $gambar->nama_file) }}" alt="Gallery"
                                        class="w-full h-20 object-cover">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex flex-col">
                    <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight" style="color: var(--text-primary);">
                        {{ $produk->nama_produk }}</h1>

                    <div class="prose prose-lg max-w-none mb-8 dark:prose-invert" 
                        style="--tw-prose-body: var(--text-secondary); --tw-prose-headings: var(--text-primary); --tw-prose-links: var(--accent-primary); --tw-prose-bold: var(--text-primary);">
                        {!! $produk->deskripsi_lengkap !!}
                    </div>

                    <!-- Call to Action / Contact -->
                    <div class="mt-auto pt-8 border-t" style="border-color: var(--border-color);">
                        <p class="text-sm mb-4 font-medium" style="color: var(--text-secondary);">Tertarik dengan produk
                            ini?</p>
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($produk->nama_produk) }}"
                            target="_blank"
                            class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-white transition-all transform hover:-translate-y-1 hover:shadow-lg gap-3 w-full sm:w-auto"
                            style="background-color: #25D366;">
                            <i class="fab fa-whatsapp text-2xl"></i>
                            <span>Hubungi Kami via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="border-t pt-16 animate-fade-in-up delay-200" style="border-color: var(--border-color);">
                    <h2 class="text-2xl font-bold mb-8" style="color: var(--text-primary);">Produk Lainnya</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('produk.detail', $related->slug) }}"
                                class="group block rounded-xl overflow-hidden border transition-all hover:-translate-y-2 hover:shadow-lg"
                                style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                                <div class="aspect-[4/3] overflow-hidden">
                                    @if($related->gambar_utama)
                                        <img src="{{ asset('storage/' . $related->gambar_utama) }}"
                                            alt="{{ $related->nama_produk }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-box text-gray-300 text-3xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <h3 class="font-bold mb-2 truncate text-lg" style="color: var(--text-primary);">
                                        {{ $related->nama_produk }}</h3>
                                    <p class="text-sm line-clamp-2 leading-relaxed" style="color: var(--text-secondary);">
                                        {{ Str::limit(strip_tags($related->deskripsi_lengkap), 60) }}
                                    </p>
                                    <div class="mt-4 flex items-center text-sm font-semibold"
                                        style="color: var(--accent-primary);">
                                        Lihat Detail <i
                                            class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</body>

</html>