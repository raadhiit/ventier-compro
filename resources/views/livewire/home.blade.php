<div class="relative">
    @if($sections->isEmpty())
        <section class="relative overflow-hidden bg-brand-black px-5 py-24 text-white sm:py-32">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.22),_transparent_45%),linear-gradient(180deg,_rgba(11,11,11,0.68)_0%,_#0B0B0B_100%)]"></div>
            <div class="relative mx-auto max-w-6xl">
                <div class="max-w-3xl">
                    <p class="text-sm font-medium uppercase tracking-[0.35em] text-champagne">Premium automotive profile</p>
                    <h1 class="mt-6 text-4xl font-semibold leading-[1.05] sm:text-5xl lg:text-6xl">Our showroom is being prepared. Brand information, product catalog, and consultations remain available.</h1>
                    <p class="mt-6 max-w-2xl text-base leading-8 text-white/70 sm:text-lg">Explore our catalog for premium materials, precise fitment, and refined details. Contact our team for quick assistance.</p>
                    <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center justify-center rounded-full bg-champagne px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-[#c6aa79]">View Products</a>
                        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/20 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/50 hover:bg-white/8">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        @php
            $hasLeadingHero = $sections->first()['section']->section_key === \App\Models\HomeSection::HERO;
        @endphp

        @if($hasLeadingHero)
            @php($heroSection = $sections->first())
            @includeIf($heroSection['view'], array_merge(['section' => $heroSection['section']], $heroSection['data']))
        @endif

        <div @class([
            'relative z-10 bg-surface-warm shadow-[0_-28px_80px_rgba(11,11,11,0.28)]',
            'rounded-t-[2rem]' => $hasLeadingHero,
        ])>
            @foreach($sections as $homeSection)
                @continue($hasLeadingHero && $loop->first)
                @includeIf($homeSection['view'], array_merge(['section' => $homeSection['section']], $homeSection['data']))
            @endforeach
        </div>
    @endif
</div>
