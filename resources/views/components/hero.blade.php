<section class="min-h-screen flex items-center px-6 py-20 section-gradient"
    style="background-color: var(--bg-primary);">
    <div class="max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text Content --}}
            <div class="space-y-8 slide-in-left">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border"
                    style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-sm font-medium tracking-wide" style="color: var(--text-secondary);">B2B Pilates
                        Supplier Indonesia</span>
                </div>

                {{-- Headline --}}
                <h1 class="text-5xl lg:text-6xl font-bold leading-tight tracking-tight"
                    style="color: var(--text-primary);">
                    Supplier Alat Pilates<br>
                    <span class="relative inline-block">
                        <span style="color: var(--accent-primary);">Profesional</span>
                        <svg class="absolute w-full h-3 -bottom-2 left-0 opacity-30" viewBox="0 0 200 10"
                            preserveAspectRatio="none" style="stroke: var(--accent-primary);">
                            <path d="M0 5 Q 100 10 200 5" stroke-width="3" fill="none" />
                        </svg>
                    </span>
                    <br>untuk Studio & Gym
                </h1>

                {{-- Subtitle --}}
                <p class="text-lg leading-relaxed" style="color: var(--text-secondary);">
                    Bangun studio Pilates yang berkualitas dengan reformer dan peralatan lengkap standar internasional.
                    Tersedia harga B2B, garansi resmi, serta dukungan instalasi.
                </p>

                {{-- CTAs --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        class="px-8 py-4 rounded-xl font-semibold text-white transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                        style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
                        Dapatkan Penawaran B2B
                    </button>
                    <button
                        class="px-8 py-4 rounded-xl font-semibold transition-all duration-300 hover:-translate-y-1 border"
                        style="background-color: var(--bg-secondary); color: var(--text-primary); border-color: var(--border-color);">
                        Konsultasi Gratis
                    </button>
                </div>

                {{-- Trust Indicators --}}
                <div class="pt-8 flex items-center gap-6 border-t" style="border-color: var(--border-color);">
                    <div class="flex -space-x-3">
                        <div class="w-12 h-12 rounded-full border-2"
                            style="background-color: var(--bg-tertiary); border-color: var(--accent-primary);"></div>
                        <div class="w-12 h-12 rounded-full border-2"
                            style="background-color: var(--bg-tertiary); border-color: var(--accent-primary);"></div>
                        <div class="w-12 h-12 rounded-full border-2 flex items-center justify-center text-sm font-bold"
                            style="background-color: var(--accent-primary); border-color: var(--accent-primary); color: white;">
                            +50
                        </div>
                    </div>
                    <div style="color: var(--text-secondary);">
                        <span class="block font-bold text-xl" style="color: var(--text-primary);">50+ Studio</span>
                        <span class="text-sm">Telah Bermitra dengan Kami</span>
                    </div>
                </div>
            </div>

            {{-- Right: Image Slider --}}
            <div class="relative slide-in-right">
                <div class="hero-slider relative aspect-[4/3] rounded-2xl overflow-hidden border"
                    style="border-color: var(--border-color);">

                    {{-- Slides --}}
                    <div class="hero-slide active absolute inset-0 transition-opacity duration-700"
                        style="background-color: var(--bg-secondary);">
                        <img src="{{ asset('images/reformer.png') }}" alt="Pilates Reformer"
                            class="w-full h-full object-cover" />
                    </div>

                    <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0"
                        style="background-color: var(--bg-secondary);">
                        <img src="{{ asset('images/cadillac.png') }}" alt="Cadillac Tower"
                            class="w-full h-full object-cover" />
                    </div>

                    <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0"
                        style="background-color: var(--bg-secondary);">
                        <img src="{{ asset('images/chair.png') }}" alt="Wunda Chair"
                            class="w-full h-full object-cover" />
                    </div>

                    {{-- Slider Dots --}}
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                        <button class="slider-dot w-2 h-2 rounded-full transition-all duration-300"
                            style="background-color: rgba(255,255,255,0.5);"></button>
                        <button class="slider-dot w-2 h-2 rounded-full transition-all duration-300"
                            style="background-color: rgba(255,255,255,0.5);"></button>
                        <button class="slider-dot w-2 h-2 rounded-full transition-all duration-300"
                            style="background-color: rgba(255,255,255,0.5);"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .hero-slide.active {
        opacity: 1;
    }

    .slider-dot.active {
        background-color: white !important;
        width: 1.5rem;
    }
</style>