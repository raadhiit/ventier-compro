@php
    $hasFilters = filled($search) || filled($category);
@endphp

<div class="bg-surface-warm text-text-primary">
    <section class="relative overflow-hidden bg-brand-black px-5 pb-20 pt-32 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_82%_18%,_rgba(183,154,99,0.22),_transparent_32%),linear-gradient(135deg,_#0B0B0B_0%,_#171717_58%,_#0B0B0B_100%)]"></div>
        <div class="relative mx-auto max-w-7xl">
            <nav class="text-sm text-white/55" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" wire:navigate class="transition hover:text-white">Home</a>
                <span class="mx-2" aria-hidden="true">/</span>
                <span class="text-champagne">Products</span>
            </nav>

            <div class="mt-12 grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.38em] text-champagne">Product catalog</p>
                    <h1 class="mt-5 max-w-4xl text-5xl font-semibold leading-[1] tracking-[-0.04em] sm:text-6xl">Browse refined car mat collections.</h1>
                </div>
                <p class="max-w-xl text-base leading-8 text-white/65 lg:justify-self-end" data-reveal>Explore published Vantier products by name, fitment cue, or category. This is a catalog for product discovery, not checkout.</p>
            </div>
        </div>
    </section>

    <section class="px-5 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="rounded-[2rem] border border-border-sand bg-white p-5 shadow-[0_24px_80px_rgba(11,11,11,0.08)] md:p-6" data-reveal>
                <div class="grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center">
                    <label class="block">
                        <span class="sr-only">Search products</span>
                        <input wire:model.live.debounce.400ms="search" type="search" placeholder="Search by product name, slug, or description" class="h-13 w-full rounded-2xl border border-border-sand bg-surface-warm px-5 text-base outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20">
                    </label>

                    @if($hasFilters)
                        <button type="button" wire:click="resetFilters" class="inline-flex h-13 items-center justify-center rounded-full border border-black/10 px-6 text-sm font-semibold text-text-primary transition hover:bg-surface-warm">
                            Reset filters
                        </button>
                    @endif
                </div>

                @if($categories->isNotEmpty())
                    <div class="mt-5 flex gap-3 overflow-x-auto pb-1" aria-label="Product categories">
                        <button type="button" wire:click="selectCategory(null)" @class([
                            'shrink-0 rounded-full border px-5 py-2.5 text-sm font-semibold transition',
                            'border-brand-black bg-brand-black text-white' => blank($category),
                            'border-border-sand bg-white text-text-secondary hover:border-champagne hover:text-text-primary' => filled($category),
                        ])>
                            All products
                        </button>
                        @foreach($categories as $productCategory)
                            <button type="button" wire:key="catalog-category-{{ $productCategory->id }}" wire:click="selectCategory('{{ $productCategory->id }}')" @class([
                                'shrink-0 rounded-full border px-5 py-2.5 text-sm font-semibold transition',
                                'border-brand-black bg-brand-black text-white' => (string) $category === (string) $productCategory->id,
                                'border-border-sand bg-white text-text-secondary hover:border-champagne hover:text-text-primary' => (string) $category !== (string) $productCategory->id,
                            ])>
                                {{ $productCategory->name }}
                            </button>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4 text-sm text-text-muted" wire:loading.flex>
                    Updating catalog...
                </div>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3" wire:loading.class="opacity-60">
                @forelse($products as $product)
                    <article wire:key="product-{{ $product->id }}" class="group overflow-hidden rounded-[2rem] border border-border-sand bg-white transition duration-500 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5" data-reveal>
                        <a href="{{ route('products.show', $product) }}" wire:navigate class="block aspect-[4/3] overflow-hidden bg-brand-carbon">
                            @if($product->thumbnail_path)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail_path) }}" alt="{{ $product->name }}" width="1200" height="1500" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="grid h-full place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.18),_transparent_44%),linear-gradient(180deg,_#262626_0%,_#171717_100%)] p-8 text-center text-sm text-white/55">Product visual coming soon</div>
                            @endif
                        </a>
                        <div class="p-7">
                            <div class="flex items-center justify-between gap-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-champagne-dark">{{ $product->category?->name ?? 'Product' }}</p>
                                @if($product->is_featured)
                                    <span class="rounded-full bg-brand-orange/15 px-3 py-1 text-xs font-semibold text-brand-black">Featured</span>
                                @endif
                            </div>
                            <h2 class="mt-4 text-2xl font-semibold leading-tight text-text-primary">{{ $product->name }}</h2>
                            @if($product->short_description)
                                <p class="mt-3 text-sm leading-7 text-text-secondary">{{ $product->short_description }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-champagne-dark transition hover:text-champagne-hover">View detail <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-[2rem] border border-border-sand bg-white px-6 py-16 text-center" data-reveal>
                        <p class="text-2xl font-semibold text-text-primary">{{ $hasFilters ? 'No products match this filter.' : 'Product catalog is being prepared.' }}</p>
                        <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-text-secondary">{{ $hasFilters ? 'Try another search term or category to continue browsing.' : 'Published products will appear here once ready in the CMS.' }}</p>
                        @if($hasFilters)
                            <button type="button" wire:click="resetFilters" class="mt-7 rounded-full bg-brand-black px-7 py-3 text-sm font-semibold text-white transition hover:bg-brand-carbon">Reset filters</button>
                        @endif
                    </div>
                @endforelse
            </div>

            @if($products->hasMorePages())
                <div class="mt-12 text-center">
                    <button wire:click="loadMore" wire:loading.attr="disabled" class="inline-flex h-13 items-center justify-center rounded-full bg-brand-black px-8 text-sm font-semibold text-white transition hover:bg-brand-carbon disabled:opacity-60">
                        <span wire:loading.remove>Load more products</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </div>
            @endif
        </div>
    </section>
</div>
