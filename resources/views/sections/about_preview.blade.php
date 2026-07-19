<section class="py-20 px-5 bg-white">
    <div class="max-w-[1262px] mx-auto grid gap-12 lg:grid-cols-2 items-center" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.8s ease-out">
        @if($section->image_path)
            <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-surface-muted relative group">
                <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            </div>
        @endif
        <div class="{{ $section->image_path ? '' : 'lg:col-span-2 text-center' }}">
            @if($section->title)
                <h2 class="text-[32px] font-semibold leading-[1.2]">{{ $section->title }}</h2>
            @endif
            @if($section->subtitle)
                <p class="mt-4 text-[17px] leading-[28px] text-text-secondary">{{ $section->subtitle }}</p>
            @endif
            @if($section->content)
                <div class="mt-6 text-[17px] leading-[28px] text-text-secondary">{!! $section->content !!}</div>
            @endif
            @if($section->cta_label && $section->cta_url)
                <a href="{{ $section->cta_url }}" class="inline-block mt-8 px-8 py-3 bg-brand-black text-white rounded-full text-[17px] font-medium hover:bg-brand-carbon transition-all duration-300 hover:scale-105">{{ $section->cta_label }}</a>
            @endif
        </div>
    </div>
</section>
