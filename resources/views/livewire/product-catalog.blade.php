<div class="bg-surface-warm">
    <section class="px-5 py-20">
        <div class="max-w-[1262px] mx-auto">
            <div class="mb-10 max-w-2xl" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out">
                <h1 class="text-[40px] sm:text-[48px] font-semibold leading-[1.1]">Product Catalog</h1>
                <p class="mt-4 text-[17px] leading-[28px] text-text-secondary">Explore Vantier products designed with precision, comfort, and vehicle-specific fit.</p>
            </div>

            <div class="mb-8 grid gap-4 md:grid-cols-[1fr_240px]" x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.6s ease-out 0.1s">
                <input wire:model.live.debounce.400ms="search" type="search" placeholder="Search products" class="h-12 rounded-xl border border-border-sand bg-white px-5 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25 transition-all">
                <select wire:model.live="category" class="h-12 rounded-xl border border-border-sand bg-white px-5 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25 transition-all">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($products as $product)
                    <article wire:key="product-{{ $product->id }}" class="bg-white border border-border-sand rounded-2xl overflow-hidden group transition-all duration-500 hover:shadow-xl hover:shadow-black/5 hover:-translate-y-1" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $loop->index * 0.05 }}s">
                        <a href="{{ route('products.show', $product) }}" class="block aspect-[4/3] bg-surface-muted overflow-hidden">
                            @if($product->thumbnail_path)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @endif
                        </a>
                        <div class="p-6">
                            <h2 class="text-xl font-semibold leading-snug">{{ $product->name }}</h2>
                            @if($product->short_description)
                                <p class="mt-3 text-sm text-text-secondary leading-relaxed">{{ $product->short_description }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="mt-5 inline-block text-sm font-semibold text-champagne hover:text-champagne-hover transition-colors">View detail →</a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-text-secondary text-center py-20">No published products found.</p>
                @endforelse
            </div>

            @if($products->hasMorePages())
                <div class="mt-12 text-center">
                    <button wire:click="loadMore" wire:loading.attr="disabled" class="h-12 rounded-full bg-brand-black px-8 text-white text-[17px] font-medium hover:bg-brand-carbon transition-all duration-300 hover:scale-105 disabled:opacity-60">
                        <span wire:loading.remove>Load more products</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </div>
            @endif
        </div>
    </section>
</div>
