<div class="bg-surface-warm">
    <section class="px-5 py-20">
        <div class="max-w-[1262px] mx-auto">
            <div class="grid gap-12 lg:grid-cols-2" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out">
                <livewire:product-gallery :images="$product->images" :thumbnail="$product->thumbnail_path" />

                <div>
                    <p class="text-sm text-text-muted uppercase tracking-wider">{{ $product->category?->name }}</p>
                    <h1 class="mt-2 text-[40px] sm:text-[48px] font-semibold leading-[1.1]">{{ $product->name }}</h1>
                    @if($product->short_description)
                        <p class="mt-6 text-[17px] leading-[28px] text-text-secondary">{{ $product->short_description }}</p>
                    @endif

                    @if($product->features)
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold">Features</h2>
                            <ul class="mt-4 space-y-3 text-[17px] leading-[28px] text-text-secondary">
                                @foreach($product->features as $feature)
                                    <li wire:key="feature-{{ $loop->index }}" class="flex items-start gap-3">
                                        <span class="mt-1.5 w-2 h-2 rounded-full bg-champagne shrink-0"></span>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($product->description)
                        <div class="prose prose-neutral mt-8 max-w-none leading-relaxed">{!! $product->description !!}</div>
                    @endif
                </div>
            </div>

            @if($relatedProducts->isNotEmpty())
                <div class="mt-20">
                    <h2 class="text-[28px] font-semibold leading-[1.2]">Related Products</h2>
                    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($relatedProducts as $relatedProduct)
                            <article wire:key="related-{{ $relatedProduct->id }}" class="bg-white border border-border-sand rounded-2xl overflow-hidden group transition-all duration-500 hover:shadow-xl hover:shadow-black/5 hover:-translate-y-1" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $loop->index * 0.1 }}s">
                                <a href="{{ route('products.show', $relatedProduct) }}" class="block aspect-[4/3] bg-surface-muted overflow-hidden">
                                    @if($relatedProduct->thumbnail_path)
                                        <img src="{{ Storage::disk('public')->url($relatedProduct->thumbnail_path) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @endif
                                </a>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold leading-snug">{{ $relatedProduct->name }}</h3>
                                    <a href="{{ route('products.show', $relatedProduct) }}" class="mt-5 inline-block text-sm font-semibold text-champagne hover:text-champagne-hover transition-colors">View detail →</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
