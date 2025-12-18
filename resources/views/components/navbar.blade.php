<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    style="background-color: var(--bg-primary); border-bottom: 1px solid var(--border-color);">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="https://www.joulwinn.com/pilates/#hero" class="text-2xl font-bold"
                style="color: var(--text-primary);">
                <span style="color: var(--accent-primary);">Pilates</span>Pro
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/#hero') }}" class="text-sm font-medium transition-colors hover:opacity-80"
                    style="color: var(--text-secondary);">Beranda</a>
                <a href="{{ url('/#features') }}" class="text-sm font-medium transition-colors hover:opacity-80"
                    style="color: var(--text-secondary);">Keunggulan</a>
                <a href="{{ url('/#products') }}" class="text-sm font-medium transition-colors hover:opacity-80"
                    style="color: var(--text-secondary);">Produk</a>
                <a href="{{ url('/#pricing') }}" class="text-sm font-medium transition-colors hover:opacity-80"
                    style="color: var(--text-secondary);">Harga</a>
                <a href="{{ url('/artikel') }}" class="text-sm font-medium transition-colors hover:opacity-80"
                    style="color: var(--text-secondary);">Artikel</a>
                <a href="{{ url('/#cta') }}"
                    class="px-6 py-2 rounded-lg font-semibold text-white text-sm transition-all duration-300 hover:shadow-lg"
                    style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
                    Hubungi Kami
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden p-2" style="color: var(--text-primary);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col gap-4">
                <a href="{{ url('/#hero') }}" class="text-sm font-medium transition-colors"
                    style="color: var(--text-secondary);">Beranda</a>
                <a href="{{ url('/#features') }}" class="text-sm font-medium transition-colors"
                    style="color: var(--text-secondary);">Keunggulan</a>
                <a href="{{ url('/#products') }}" class="text-sm font-medium transition-colors"
                    style="color: var(--text-secondary);">Produk</a>
                <a href="{{ url('/#pricing') }}" class="text-sm font-medium transition-colors"
                    style="color: var(--text-secondary);">Harga</a>
                <a href="{{ url('/artikel') }}" class="text-sm font-medium transition-colors"
                    style="color: var(--text-secondary);">Artikel</a>
                <a href="/#cta" class="px-6 py-2 rounded-lg font-semibold text-white text-sm text-center"
                    style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Spacer to prevent content from hiding under fixed navbar --}}
<div class="h-20"></div>