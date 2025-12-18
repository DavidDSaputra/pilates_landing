@props(['testimonials' => []])

<section class="py-24 px-6 border-t section-gradient"
    style="background-color: var(--bg-primary); border-color: var(--border-color);">
    <div class="max-w-7xl mx-auto">
        {{-- Section Header --}}
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-primary);">
                Apa Kata Klien Kami
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-secondary);">
                Dipercaya oleh studio Pilates dan gym terkemuka di Indonesia
            </p>
        </div>

        {{-- Testimonials Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-grid">
            @forelse($testimonials as $testimonial)
                <div class="p-8 rounded-2xl border transition-all duration-300 hover:-translate-y-2 stagger-item flex flex-col h-full"
                    style="background-color: var(--bg-secondary); border-color: var(--border-color);">

                    {{-- Rating Stars --}}
                    <div class="flex gap-1 mb-4 text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star text-sm"></i>
                            @else
                                <i class="far fa-star text-sm text-gray-600"></i>
                            @endif
                        @endfor
                    </div>

                    <div class="text-5xl mb-4 opacity-20 leading-none h-8" style="color: var(--accent-primary);">❝</div>

                    <p class="text-lg mb-6 leading-relaxed italic flex-1" style="color: var(--text-primary);">
                        "{{ $testimonial->isi }}"
                    </p>

                    <div class="pt-6 border-t mt-auto flex items-center gap-4" style="border-color: var(--border-color);">
                        @if($testimonial->foto)
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0 border-2"
                                style="border-color: var(--accent-primary);">
                                <img src="{{ asset('storage/' . $testimonial->foto) }}" alt="{{ $testimonial->nama }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0"
                                style="background-color: var(--bg-tertiary); color: var(--accent-primary);">
                                {{ substr($testimonial->nama, 0, 1) }}
                            </div>
                        @endif

                        <div>
                            <h4 class="font-bold text-base" style="color: var(--text-primary);">
                                {{ $testimonial->nama }}
                            </h4>
                            <p class="text-sm" style="color: var(--text-secondary);">
                                {{ $testimonial->pekerjaan }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                    <div class="inline-block p-4 rounded-full bg-gray-100 mb-4 dark:bg-gray-800">
                        <i class="far fa-comment-dots text-3xl text-gray-400"></i>
                    </div>
                    <p class="text-lg text-gray-500">Belum ada testimoni saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>