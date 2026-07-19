<section class="py-20 px-5 bg-brand-black text-white" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.8s ease-out">
    <div class="max-w-[1262px] mx-auto text-center">
        @if($section->title)
            <h2 class="text-[32px] font-semibold leading-[1.2]">{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mt-4 text-[17px] leading-[28px] text-white/60 max-w-2xl mx-auto">{{ $section->subtitle }}</p>
        @endif
        @if($section->cta_label && $section->cta_url)
            <a href="{{ $section->cta_url }}" class="inline-block mt-8 px-8 py-3 bg-white text-text-primary rounded-full text-[17px] font-medium hover:bg-surface-muted transition-all duration-300 hover:scale-105">{{ $section->cta_label }}</a>
        @endif
    </div>
</section>
