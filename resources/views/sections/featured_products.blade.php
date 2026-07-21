<section class="bg-surface-warm px-5 py-20">
    <div class="mx-auto max-w-[1262px]">
        @if($section->title)
            <h2 class="text-center text-[32px] font-semibold leading-[1.2]" data-reveal>{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mx-auto mt-4 max-w-2xl text-center text-[17px] leading-[28px] text-text-secondary" data-reveal>{{ $section->subtitle }}</p>
        @endif
        @if($products->isNotEmpty())
            <div class="mt-12 grid gap-6 lg:grid-cols-2">
                @foreach($products as $product)
                    <article wire:key="home-featured-product-{{ $product->id }}" @class([
                        'group overflow-hidden rounded-[2rem] border border-border-sand bg-white transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5',
                        'lg:row-span-2' => $loop->first,
                    ]) data-reveal>
                        <a href="{{ route('products.show', $product) }}" wire:navigate @class([
                            'block overflow-hidden bg-surface-muted',
                            'aspect-[4/3] lg:aspect-auto lg:h-[560px]' => $loop->first,
                            'aspect-[16/9] lg:h-[250px]' => ! $loop->first,
                        ])>
                            @if($product->thumbnail_path)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail_path) }}" alt="{{ $product->name }}" width="1200" height="1500" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="grid h-full place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.2),_transparent_45%),linear-gradient(180deg,_#262626_0%,_#171717_100%)] p-8 text-center text-sm text-white/55">Product visual</div>
                            @endif
                        </a>
                        <div @class(['p-7', 'lg:p-9' => $loop->first])>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-champagne-dark">Featured product</p>
                            <h3 @class(['mt-3 font-semibold leading-snug text-text-primary', 'text-3xl' => $loop->first, 'text-xl' => ! $loop->first])>{{ $product->name }}</h3>
                            @if($product->short_description)
                                <p class="mt-3 max-w-xl text-sm leading-7 text-text-secondary">{{ $product->short_description }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" wire:navigate class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-champagne-dark transition-colors hover:text-champagne-hover">View detail <span aria-hidden="true">→</span></a>
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
