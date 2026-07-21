<section class="bg-brand-carbon px-5 py-24 text-white">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20">
            <div data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-champagne">Designed around use</p>
                @if($section->title)
                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] sm:text-5xl">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                    <p class="mt-6 max-w-xl text-base leading-8 text-white/60">{{ $section->subtitle }}</p>
                @endif
            </div>

            <div>
                @if($section->content)
                    <div class="max-w-2xl text-lg leading-9 text-white/68" data-reveal>{!! $section->content !!}</div>
                @endif

                <div class="mt-10 divide-y divide-white/10 border-y border-white/10">
                    <article class="grid gap-4 py-7 sm:grid-cols-[80px_1fr]" data-reveal>
                        <p class="text-sm font-semibold text-champagne">01</p>
                        <div>
                            <h3 class="text-xl font-semibold">Material premium</h3>
                            <p class="mt-2 text-sm leading-7 text-white/55">Komposisi material dipilih untuk daya tahan, kemudahan perawatan, dan tampilan interior yang rapi.</p>
                        </div>
                    </article>
                    <article class="grid gap-4 py-7 sm:grid-cols-[80px_1fr]" data-reveal>
                        <p class="text-sm font-semibold text-champagne">02</p>
                        <div>
                            <h3 class="text-xl font-semibold">Presisi kendaraan</h3>
                            <p class="mt-2 text-sm leading-7 text-white/55">Bentuk dan coverage diarahkan pada fitment yang lebih meyakinkan, bukan produk generik satu ukuran.</p>
                        </div>
                    </article>
                    <article class="grid gap-4 py-7 sm:grid-cols-[80px_1fr]" data-reveal>
                        <p class="text-sm font-semibold text-champagne">03</p>
                        <div>
                            <h3 class="text-xl font-semibold">Proteksi yang refined</h3>
                            <p class="mt-2 text-sm leading-7 text-white/55">Fungsi proteksi tetap utama, disampaikan lewat detail visual dan finishing yang tidak berlebihan.</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
