<section class="relative flex min-h-[760px] items-center overflow-hidden bg-brand-black px-5 pb-24 pt-32 text-white" data-hero>
    @if($section->image_path)
        <div class="absolute inset-0" data-hero-image>
            <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title ?: 'Premium automotive interior' }}" width="1920" height="1200" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,_rgba(11,11,11,0.92)_0%,_rgba(11,11,11,0.62)_46%,_rgba(11,11,11,0.18)_100%)]"></div>
            <div class="absolute inset-x-0 bottom-0 h-56 bg-gradient-to-t from-brand-black to-transparent"></div>
        </div>
    @else
        <div class="absolute inset-0" data-hero-image>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_72%_18%,_rgba(183,154,99,0.26),_transparent_32%),linear-gradient(135deg,_#0B0B0B_0%,_#171717_52%,_#0B0B0B_100%)]"></div>
            <div class="absolute left-1/2 top-20 h-[520px] w-[520px] -translate-x-1/3 rounded-full border border-champagne/15"></div>
            <div class="absolute bottom-16 right-8 h-px w-1/2 bg-gradient-to-r from-transparent via-champagne/40 to-transparent"></div>
        </div>
    @endif

    <div class="relative z-10 mx-auto w-full max-w-7xl">
        <div class="max-w-4xl">
            <p class="text-xs font-semibold uppercase tracking-[0.42em] text-champagne" data-hero-eyebrow>Premium Couture Carmat</p>

            @if($section->title)
                <h1 class="mt-6 max-w-4xl text-5xl font-semibold leading-[0.98] tracking-[-0.04em] text-white sm:text-6xl lg:text-7xl" data-hero-title>{{ $section->title }}</h1>
            @endif

            @if($section->subtitle)
                <p class="mt-7 max-w-2xl text-base leading-8 text-white/72 sm:text-lg" data-hero-copy>{{ $section->subtitle }}</p>
            @endif

            <div class="mt-10 flex flex-col gap-4 sm:flex-row" data-hero-action>
                @if($section->cta_label && $section->cta_url)
                    <a href="{{ $section->cta_url }}" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-orange-soft">{{ $section->cta_label }}</a>
                @endif
                <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/18 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/45 hover:bg-white/8 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">Konsultasi Produk</a>
            </div>
        </div>

        <div class="mt-20 grid gap-px overflow-hidden rounded-3xl border border-white/10 bg-white/10 backdrop-blur-sm md:grid-cols-4" data-hero-action>
            <div class="bg-brand-black/58 p-6">
                <p class="text-xs uppercase tracking-[0.28em] text-champagne">01</p>
                <p class="mt-4 text-sm font-semibold text-white">Premium material</p>
                <p class="mt-2 text-sm leading-6 text-white/55">Dipilih untuk proteksi, grip, dan rasa kabin yang refined.</p>
            </div>
            <div class="bg-brand-black/58 p-6">
                <p class="text-xs uppercase tracking-[0.28em] text-champagne">02</p>
                <p class="mt-4 text-sm font-semibold text-white">Precise fit</p>
                <p class="mt-2 text-sm leading-6 text-white/55">Profil produk fokus pada kerapian fitment dan coverage.</p>
            </div>
            <div class="bg-brand-black/58 p-6">
                <p class="text-xs uppercase tracking-[0.28em] text-champagne">03</p>
                <p class="mt-4 text-sm font-semibold text-white">Easy inquiry</p>
                <p class="mt-2 text-sm leading-6 text-white/55">Katalog membantu pilih produk sebelum kontak tim.</p>
            </div>
            <div class="bg-brand-black/58 p-6">
                <p class="text-xs uppercase tracking-[0.28em] text-champagne">04</p>
                <p class="mt-4 text-sm font-semibold text-white">Warm automotive</p>
                <p class="mt-2 text-sm leading-6 text-white/55">Visual premium tanpa rasa marketplace atau checkout.</p>
            </div>
        </div>
    </div>
</section>
