<section class="relative h-[80vh] min-h-[600px] flex items-center justify-center overflow-hidden bg-brand-black" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
    @if($section->image_path)
        <div class="absolute inset-0" :class="loaded ? 'opacity-100' : 'opacity-0'" style="transition: opacity 1s ease-out">
            <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/60"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-brand-black via-brand-carbon to-graphite"></div>
    @endif
    <div class="relative z-10 text-center px-5 max-w-3xl mx-auto" x-show="loaded" x-transition.opacity.duration.1000ms>
        @if($section->title)
            <h1 class="text-[40px] sm:text-[48px] lg:text-[56px] font-semibold leading-[1.1] text-white">{{ $section->title }}</h1>
        @endif
        @if($section->subtitle)
            <p class="mt-6 text-[17px] leading-[28px] text-white/70 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
        @endif
        @if($section->cta_label && $section->cta_url)
            <a href="{{ $section->cta_url }}" class="inline-block mt-8 px-8 py-3 bg-white text-text-primary rounded-full text-[17px] font-medium hover:bg-surface-muted transition-all duration-300 hover:scale-105">{{ $section->cta_label }}</a>
        @endif
    </div>
</section>
