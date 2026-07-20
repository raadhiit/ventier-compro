<?php

$products = \App\Models\Product::query()
    ->published()
    ->where('is_featured', true)
    ->orderBy('sort_order')
    ->limit((int) ($section->settings['limit'] ?? 6))
    ->get();

?>
<section class="py-20 px-5 bg-surface-warm">
    <div class="max-w-[1262px] mx-auto">
        @if($section->title)
            <h2 class="text-[32px] font-semibold leading-[1.2] text-center" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out">{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mt-4 text-[17px] leading-[28px] text-text-secondary max-w-2xl mx-auto text-center" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out 0.1s">{{ $section->subtitle }}</p>
        @endif
        @if($products->isNotEmpty())
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                    <article wire:key="product-{{ $product->id }}" class="bg-white border border-border-sand rounded-2xl overflow-hidden group transition-all duration-500 hover:shadow-xl hover:shadow-black/5 hover:-translate-y-1" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $loop->index * 0.1 }}s">
                        <a href="{{ route('products.show', $product) }}" class="block aspect-[4/3] bg-surface-muted overflow-hidden">
                            @if($product->thumbnail_path)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @endif
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold leading-snug">{{ $product->name }}</h3>
                            @if($product->short_description)
                                <p class="mt-3 text-sm text-text-secondary leading-relaxed">{{ $product->short_description }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="mt-5 inline-block text-sm font-semibold text-champagne hover:text-champagne-hover transition-colors">View detail →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
