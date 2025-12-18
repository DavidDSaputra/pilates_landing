<footer class="py-16 px-6 border-t" style="background-color: var(--bg-secondary); border-color: var(--border-color);">
    <div class="max-w-7xl mx-auto">

        {{-- Middle Section: Links --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-12 border-t border-b"
            style="border-color: var(--border-color);">
            {{-- Pages --}}
            <div>
                <h4 class="text-sm font-bold mb-4" style="color: var(--text-primary);">Pages</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Beranda</a></li>
                    <li><a href="{{ url('/#features') }}" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Keunggulan</a></li>
                    <li><a href="{{ url('/#products') }}" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Produk</a></li>
                    <li><a href="{{ url('/#pricing') }}" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Harga</a></li>
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="text-sm font-bold mb-4" style="color: var(--text-primary);">Resources</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/artikel') }}" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Artikel</a></li>
                    <li><a href="#" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Panduan</a></li>
                    <li><a href="#" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">FAQ</a></li>
                    <li><a href="#" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">Katalog</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-sm font-bold mb-4" style="color: var(--text-primary);">Contact</h4>
                <ul class="space-y-2">
                    <li><a href="mailto:joulwinnofficial@gmail.com" class="text-sm transition-colors hover:opacity-70"
                            style="color: var(--text-secondary);">joulwinnofficial@gmail.com</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=6281258887895" target="_blank"
                            class="text-sm transition-colors hover:opacity-70" style="color: var(--text-secondary);">+62
                            812 5888 7895 (WhatsApp)</a></li>
                </ul>
            </div>

            {{-- Location --}}
            <div>
                <h4 class="text-sm font-bold mb-4" style="color: var(--text-primary);">Location</h4>
                <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
                    BSD Ruko Boulevard, Jalan Raya Taman Tekhno Lt.2,<br>
                    Blok AA No. 7, Ciater, Kec. Serpong,<br>
                    Kota Tangerang Selatan, Banten 15323
                </p>
            </div>
        </div>

        {{-- Bottom Section: Copyright --}}
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm" style="color: var(--text-tertiary);">
                © 2024 PilatesPro. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-sm transition-colors hover:opacity-70"
                    style="color: var(--text-tertiary);">Privacy Policy</a>
                <span style="color: var(--border-color);">•</span>
                <a href="#" class="text-sm transition-colors hover:opacity-70"
                    style="color: var(--text-tertiary);">Terms & Conditions</a>
            </div>
        </div>

    </div>
</footer>