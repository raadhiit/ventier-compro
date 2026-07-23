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
                    <article class="grid gap-5 py-7 sm:grid-cols-[72px_1fr]" data-reveal>
                        <div class="flex size-14 items-center justify-center rounded-2xl border border-champagne/20 bg-champagne/10 text-champagne">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m5.25 2.625a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Premium Materials</h3>
                            <p class="mt-2 max-w-xl text-sm leading-7 text-white/55">Durable, easy-care materials with a refined interior finish.</p>
                        </div>
                    </article>

                    <article class="grid gap-5 py-7 sm:grid-cols-[72px_1fr]" data-reveal>
                        <div class="flex size-14 items-center justify-center rounded-2xl border border-champagne/20 bg-champagne/10 text-champagne">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0 1 7.5-7.5h7.5V12A7.5 7.5 0 1 1 4.5 12Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v7.5h7.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Precise Fitment</h3>
                            <p class="mt-2 max-w-xl text-sm leading-7 text-white/55">Vehicle-specific coverage instead of a generic one-size shape.</p>
                        </div>
                    </article>

                    <article class="grid gap-5 py-7 sm:grid-cols-[72px_1fr]" data-reveal>
                        <div class="flex size-14 items-center justify-center rounded-2xl border border-champagne/20 bg-champagne/10 text-champagne">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 4.5v4.75c0 4.28-2.912 8.232-7.5 9.75-4.588-1.518-7.5-5.47-7.5-9.75V7.5L12 3Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">Refined Protection</h3>
                            <p class="mt-2 max-w-xl text-sm leading-7 text-white/55">Daily protection delivered through clean detailing and restrained finishing.</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
