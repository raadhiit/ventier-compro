<section class="relative bg-brand-black text-white" data-hero>
    <div class="pointer-events-none fixed inset-0 h-screen overflow-hidden" data-hero-image>
        @if($section->image_path)
            <div class="absolute inset-0">
                <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title ?: 'Premium automotive interior' }}" width="1920" height="1200" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-[linear-gradient(90deg,_rgba(11,11,11,0.92)_0%,_rgba(11,11,11,0.62)_46%,_rgba(11,11,11,0.18)_100%)]"></div>
                <div class="absolute inset-x-0 bottom-0 h-56 bg-gradient-to-t from-brand-black to-transparent"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_72%_18%,_rgba(183,154,99,0.26),_transparent_32%),linear-gradient(135deg,_#0B0B0B_0%,_#171717_52%,_#0B0B0B_100%)]"></div>
            <div class="absolute left-1/2 top-20 h-[520px] w-[520px] -translate-x-1/3 rounded-full border border-champagne/15"></div>
            <div class="absolute bottom-16 right-8 h-px w-1/2 bg-gradient-to-r from-transparent via-champagne/40 to-transparent"></div>
        @endif
    </div>

    <div class="relative z-10 flex min-h-screen items-center px-5 py-28">
        <div class="mx-auto w-full max-w-7xl">
            <div class="max-w-4xl">
                <p class="text-xs font-semibold uppercase tracking-[0.42em] text-champagne" data-hero-eyebrow>Premium Couture Carmat</p>

                @if($section->title)
                    <h1 class="mt-6 max-w-4xl text-[2.5rem] font-semibold leading-[0.98] tracking-[-0.04em] text-[#F7F4ED] sm:text-[3.1rem] lg:whitespace-nowrap lg:text-[3.55rem]" data-hero-title>{{ $section->title }}</h1>
                @endif

                <div class="mt-10 flex flex-col gap-4 sm:flex-row" data-hero-action>
                    @if($section->cta_label && $section->cta_url)
                        <a href="{{ $section->cta_url }}" class="inline-flex items-center justify-center rounded-full bg-[#A86F45] px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-[#955f39] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#A86F45]">{{ $section->cta_label }}</a>
                    @endif
                    <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/18 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/45 hover:bg-white/8 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">Product Consultation</a>
                </div>
            </div>
        </div>
    </div>
</section>
