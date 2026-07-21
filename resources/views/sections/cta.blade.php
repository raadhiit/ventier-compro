<section class="relative overflow-hidden bg-brand-black px-5 py-28 text-white">
    @if($section->image_path)
        <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title ?: 'Contact Vantier' }}" width="1920" height="1000" loading="lazy" class="absolute inset-0 h-full w-full object-cover opacity-45">
    @endif
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,_rgba(217,145,98,0.24),_transparent_35%),linear-gradient(90deg,_rgba(11,11,11,0.98)_0%,_rgba(11,11,11,0.82)_54%,_rgba(11,11,11,0.52)_100%)]"></div>

    <div class="relative mx-auto max-w-7xl" data-reveal>
        <div class="max-w-3xl">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-brand-orange-soft">Start with a conversation</p>
            @if($section->title)
                <h2 class="mt-6 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] sm:text-5xl lg:text-6xl">{{ $section->title }}</h2>
            @endif
            @if($section->subtitle)
                <p class="mt-6 max-w-2xl text-base leading-8 text-white/65 sm:text-lg">{{ $section->subtitle }}</p>
            @endif
            <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                @if($section->cta_label && $section->cta_url)
                    <a href="{{ $section->cta_url }}" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-orange-soft">{{ $section->cta_label }}</a>
                @endif
                <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/18 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/45 hover:bg-white/8 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">Contact page</a>
            </div>
        </div>
    </div>
</section>
