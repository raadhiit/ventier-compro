<section class="bg-surface-warm px-5 py-20">
    <div class="mx-auto max-w-[1262px]">
        @if($section->title)
            <h2 class="text-center text-[32px] font-semibold leading-[1.2] text-text-primary" data-reveal>{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mx-auto mt-4 max-w-2xl text-center text-[17px] leading-[28px] text-text-secondary" data-reveal>{{ $section->subtitle }}</p>
        @endif
        @if($categories->isNotEmpty())
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($categories as $category)
                    <article wire:key="home-product-category-{{ $category->id }}" class="group min-h-72 overflow-hidden rounded-[2rem] border border-border-sand bg-white transition duration-500 hover:-translate-y-1 hover:border-champagne/50 hover:shadow-xl hover:shadow-black/5 motion-reduce:transform-none motion-reduce:transition-none" data-reveal>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" wire:navigate class="flex h-full flex-col p-7">
                            <div class="flex size-12 items-center justify-center rounded-2xl border border-champagne/25 bg-champagne/10 text-champagne-dark">
                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 7.5 12 3l7.5 4.5v9L12 21l-7.5-4.5v-9Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7.5 7.5 4.5 7.5-4.5M12 12v9" />
                                </svg>
                            </div>
                            <div class="mt-auto pt-12">
                                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-champagne-dark">Product category</p>
                                <h3 class="mt-3 text-2xl font-semibold leading-tight text-text-primary">{{ $category->name }}</h3>
                                @if($category->description)
                                    <p class="mt-3 line-clamp-3 text-sm leading-7 text-text-secondary">{{ $category->description }}</p>
                                @endif
                                <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-champagne-dark transition-colors group-hover:text-champagne-hover">Explore category <span aria-hidden="true">→</span></span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-3xl border border-border-sand bg-white px-6 py-12 text-center" data-reveal>
                <p class="text-lg font-semibold text-text-primary">Product categories are being prepared.</p>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-text-secondary">Browse our full catalog to view all published products.</p>
                <a href="{{ route('products.index') }}" wire:navigate class="mt-6 inline-flex rounded-full bg-brand-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-brand-carbon">View Catalog</a>
            </div>
        @endif
    </div>
</section>
