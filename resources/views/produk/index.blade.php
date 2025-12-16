<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Produk Kami | Pilates</title>
    <meta name="description"
        content="Koleksi lengkap peralatan dan perlengkapan Pilates berkualitas tinggi untuk studio dan penggunaan di rumah.">

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

            <!-- Page Header -->
            <div class="text-center mb-16 animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-primary);">
                    Produk Kami
                </h1>
                <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-secondary);">
                    Temukan peralatan Pilates terbaik untuk kebutuhan latihan Anda
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($produks as $produk)
                    <article
                        class="rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 border group flex flex-col h-full shadow-sm hover:shadow-lg"
                        style="background-color: var(--bg-secondary); border-color: var(--border-color);">

                        <a href="{{ route('produk.detail', $produk->slug) }}"
                            class="block relative overflow-hidden aspect-[4/3]">
                            @if($produk->gambar_utama)
                                <img src="{{ asset('storage/' . $produk->gambar_utama) }}" alt="{{ $produk->nama_produk }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-box text-5xl text-gray-300"></i>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                            </div>
                        </a>

                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-amber-600 transition-colors"
                                style="color: var(--text-primary);">
                                <a href="{{ route('produk.detail', $produk->slug) }}">
                                    {{ $produk->nama_produk }}
                                </a>
                            </h3>

                            <p class="text-sm leading-relaxed mb-4 flex-1 line-clamp-3"
                                style="color: var(--text-secondary);">
                                {{ Str::limit(strip_tags($produk->deskripsi_lengkap), 100) }}
                            </p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t"
                                style="border-color: var(--border-color);">
                                <a href="{{ route('produk.detail', $produk->slug) }}"
                                    class="inline-flex items-center gap-2 text-sm font-semibold transition-all group-hover:gap-3"
                                    style="color: var(--accent-primary);">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-block p-6 rounded-full bg-gray-100 mb-6 dark:bg-gray-800">
                            <i class="fas fa-box-open text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">Belum ada produk</h3>
                        <p style="color: var(--text-secondary);">Produk akan segera ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $produks->links() }}
            </div>

        </div>
    </div>

    <x-footer />
</body>

</html>