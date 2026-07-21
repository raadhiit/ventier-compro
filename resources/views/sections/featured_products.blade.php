<section class="bg-surface-warm px-5 py-20">
    <div class="mx-auto max-w-[1262px]">
        @if($section->title)
            <h2 class="text-center text-[32px] font-semibold leading-[1.2]" data-reveal>{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mx-auto mt-4 max-w-2xl text-center text-[17px] leading-[28px] text-text-secondary" data-reveal>{{ $section->subtitle }}</p>
        @endif
        @if($products->isNotEmpty())
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                    <article wire:key="home-featured-product-{{ $product->id }}" class="group overflow-hidden rounded-2xl border border-border-sand bg-white transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5" data-reveal>
                        <a href="{{ route('products.show', $product) }}" wire:navigate class="block aspect-[4/3] overflow-hidden bg-surface-muted">
                            @if($product->thumbnail_path)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail_path) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold leading-snug">{{ $product->name }}</h3>
                            @if($product->short_description)
                                <p class="mt-3 text-sm leading-relaxed text-text-secondary">{{ $product->short_description }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" wire:navigate class="mt-5 inline-block text-sm font-semibold text-champagne transition-colors hover:text-champagne-hover">View detail →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-3xl border border-border-sand bg-white px-6 py-12 text-center" data-reveal>
                <p class="text-lg font-semibold text-text-primary">Produk unggulan sedang disiapkan.</p>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-text-secondary">Katalog lengkap tetap tersedia untuk melihat pilihan produk yang sudah dipublikasikan.</p>
                <a href="{{ route('products.index') }}" wire:navigate class="mt-6 inline-flex rounded-full bg-brand-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-brand-carbon">Lihat katalog</a>
            </div>
        @endif
    </div>
</section>
