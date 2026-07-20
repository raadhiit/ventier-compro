<?php

$articles = \App\Models\Article::query()
    ->published()
    ->latest('published_at')
    ->limit((int) ($section->settings['limit'] ?? 3))
    ->get();

?>
<section class="py-20 px-5 bg-white">
    <div class="max-w-[1262px] mx-auto">
        @if($section->title)
            <h2 class="text-[32px] font-semibold leading-[1.2] text-center" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out">{{ $section->title }}</h2>
        @endif
        @if($articles->isNotEmpty())
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($articles as $article)
                    <article class="bg-surface-warm border border-border-sand rounded-2xl overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-black/5 hover:-translate-y-1" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $loop->index * 0.1 }}s">
                        @if($article->cover_image_path)
                            <div class="aspect-[4/3] overflow-hidden bg-surface-muted">
                                <img src="{{ Storage::disk('public')->url($article->cover_image_path) }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold leading-snug">{{ $article->title }}</h3>
                            @if($article->excerpt)
                                <p class="mt-3 text-sm text-text-secondary leading-relaxed">{{ $article->excerpt }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
