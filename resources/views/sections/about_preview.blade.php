<section class="bg-surface-warm px-5 py-24">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div class="order-2 lg:order-1" data-reveal>
                <div class="inline-flex items-center gap-2 rounded-full border border-champagne/25 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-champagne-dark">Brand story</div>
                @if($section->title)
                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] text-text-primary sm:text-5xl">{{ $section->title }}</h2>
                @endif
                @if($section->subtitle)
                    <p class="mt-6 max-w-xl text-base leading-8 text-text-secondary">{{ $section->subtitle }}</p>
                @endif
                @if($section->content)
                    <div class="mt-8 max-w-xl text-base leading-8 text-text-secondary">{!! $section->content !!}</div>
                @endif
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    @if($section->cta_label && $section->cta_url)
                        <a href="{{ $section->cta_url }}" wire:navigate class="inline-flex items-center justify-center rounded-full bg-brand-black px-8 py-3 text-sm font-semibold text-white transition hover:bg-brand-carbon focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">{{ $section->cta_label }}</a>
                    @endif
                    <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-black/10 px-8 py-3 text-sm font-semibold text-text-primary transition hover:bg-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">View Catalog</a>
                </div>
            </div>

            <div class="order-1 overflow-hidden rounded-[2rem] border border-border-sand bg-brand-black shadow-[0_24px_80px_rgba(11,11,11,0.22)] lg:order-2" data-reveal>
                @if($section->image_path)
                    <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title }}" width="1600" height="1200" loading="lazy" class="h-full w-full object-cover">
                @else
                    <div class="grid min-h-[520px] place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.2),_transparent_42%),linear-gradient(180deg,_#171717_0%,_#0B0B0B_100%)] p-10 text-center">
                        <div class="max-w-md">
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-champagne">Editorial frame</p>
                            <p class="mt-5 text-2xl font-semibold leading-tight text-white">This section is ready for a lifestyle or studio image.</p>
                            <p class="mt-4 text-sm leading-7 text-white/60">One strong image keeps the brand premium without adding clutter.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
