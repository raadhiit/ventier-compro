<div class="bg-surface-warm px-5 py-20">
    <div class="max-w-[1262px] mx-auto">
        @if($sections->isEmpty())
            <div class="text-center py-20">
                <h1 class="text-[40px] font-semibold">About Us</h1>
                <p class="mt-4 text-text-secondary">Content coming soon.</p>
            </div>
        @else
            @foreach($sections as $section)
                <section class="mb-20 last:mb-0" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $loop->index * 0.15 }}s">
                    @if($section->title)
                        <h2 class="text-[32px] font-semibold leading-[1.2]">{{ $section->title }}</h2>
                    @endif
                    @if($section->subtitle)
                        <p class="mt-4 text-[17px] leading-[28px] text-text-secondary">{{ $section->subtitle }}</p>
                    @endif
                    @if($section->content)
                        <div class="mt-6 text-[17px] leading-[28px] text-text-secondary max-w-2xl">{!! $section->content !!}</div>
                    @endif
                    @if($section->image_path)
                        <div class="mt-10 aspect-[4/3] lg:aspect-[16/7] overflow-hidden rounded-2xl bg-surface-muted group">
                            <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                    @endif
                    @if($section->cta_label && $section->cta_url)
                        <a href="{{ $section->cta_url }}" class="inline-block mt-8 px-8 py-3 bg-brand-black text-white rounded-full text-[17px] font-medium hover:bg-brand-carbon transition-all duration-300 hover:scale-105">{{ $section->cta_label }}</a>
                    @endif
                </section>
            @endforeach
        @endif
    </div>
</div>
