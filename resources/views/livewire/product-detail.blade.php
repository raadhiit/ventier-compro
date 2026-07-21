@php
    $rawWhatsApp = (string) ($siteSettings['whatsapp_number'] ?? '');
    $whatsAppDigits = preg_replace('/\D+/', '', $rawWhatsApp);

    if (str_starts_with($whatsAppDigits, '0')) {
        $whatsAppDigits = '62'.substr($whatsAppDigits, 1);
    }

    $whatsAppUrl = $whatsAppDigits !== ''
        ? 'https://wa.me/'.$whatsAppDigits.'?text='.rawurlencode('Halo, saya ingin mengetahui lebih lanjut tentang '.$product->name.'.')
        : null;
@endphp

<div class="bg-surface-warm text-text-primary">
    <section class="px-5 pb-20 pt-12">
        <div class="mx-auto max-w-7xl">
            <nav class="text-sm text-text-muted" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" wire:navigate class="transition hover:text-text-primary">Home</a>
                <span class="mx-2" aria-hidden="true">/</span>
                <a href="{{ route('products.index') }}" wire:navigate class="transition hover:text-text-primary">Products</a>
                <span class="mx-2" aria-hidden="true">/</span>
                <span class="text-champagne-dark" aria-current="page">{{ $product->name }}</span>
            </nav>

            <div class="mt-10 grid gap-12 lg:grid-cols-[1.08fr_0.92fr] lg:items-start">
                <div data-reveal>
                    <livewire:product-gallery :images="$product->images" :thumbnail="$product->thumbnail_path" :product-name="$product->name" />
                </div>

                <div class="lg:sticky lg:top-28" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">{{ $product->category?->name ?? 'Premium product' }}</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-[1.02] tracking-[-0.035em] sm:text-5xl lg:text-6xl">{{ $product->name }}</h1>
                    @if($product->short_description)
                        <p class="mt-6 text-base leading-8 text-text-secondary sm:text-lg">{{ $product->short_description }}</p>
                    @endif

                    @if($product->material)
                        <div class="mt-8 border-y border-border-sand py-5">
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-text-muted">Material</p>
                            <p class="mt-2 text-base font-semibold text-text-primary">{{ $product->material }}</p>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @if($whatsAppUrl)
                            <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft">Ask via WhatsApp</a>
                        @endif
                        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-black/12 px-8 py-3 text-sm font-semibold text-text-primary transition hover:bg-white">Contact team</a>
                    </div>

                    <p class="mt-5 text-xs leading-6 text-text-muted">Product inquiry only. No cart or checkout required.</p>
                </div>
            </div>
        </div>
    </section>

    @if($product->features || $product->specifications)
        <section class="bg-brand-carbon px-5 py-20 text-white">
            <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-2">
                @if($product->features)
                    <div data-reveal>
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne">Product benefits</p>
                        <h2 class="mt-4 text-3xl font-semibold tracking-[-0.025em]">Built around daily protection.</h2>
                        <ul class="mt-8 divide-y divide-white/10 border-y border-white/10">
                            @foreach($product->features as $feature)
                                <li wire:key="feature-{{ $loop->index }}" class="grid grid-cols-[48px_1fr] gap-4 py-5">
                                    <span class="text-sm font-semibold text-champagne">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-sm leading-7 text-white/68">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($product->specifications)
                    <div data-reveal>
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne">Specifications</p>
                        <h2 class="mt-4 text-3xl font-semibold tracking-[-0.025em]">Details at a glance.</h2>
                        <dl class="mt-8 divide-y divide-white/10 border-y border-white/10">
                            @foreach($product->specifications as $label => $value)
                                <div wire:key="specification-{{ $loop->index }}" class="grid gap-2 py-5 sm:grid-cols-[0.8fr_1.2fr]">
                                    <dt class="text-sm text-white/48">{{ $label }}</dt>
                                    <dd class="text-sm font-semibold leading-7 text-white">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if($product->description)
        <section class="px-5 py-20">
            <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[0.6fr_1.4fr]" data-reveal>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">Product story</p>
                    <h2 class="mt-4 text-3xl font-semibold tracking-[-0.025em]">More than surface protection.</h2>
                </div>
                <div class="max-w-3xl text-base leading-8 text-text-secondary">{!! $product->description !!}</div>
            </div>
        </section>
    @endif

    @if($relatedProducts->isNotEmpty())
        <section class="border-t border-border-sand px-5 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">Continue browsing</p>
                        <h2 class="mt-4 text-3xl font-semibold tracking-[-0.025em]">Related products</h2>
                    </div>
                    <a href="{{ route('products.index') }}" wire:navigate class="text-sm font-semibold text-champagne-dark transition hover:text-champagne-hover">View catalog →</a>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedProducts as $relatedProduct)
                        <article wire:key="related-{{ $relatedProduct->id }}" class="group overflow-hidden rounded-[2rem] border border-border-sand bg-white transition duration-500 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/5" data-reveal>
                            <a href="{{ route('products.show', $relatedProduct) }}" wire:navigate class="block aspect-[4/3] overflow-hidden bg-brand-carbon">
                                @if($relatedProduct->thumbnail_path)
                                    <img src="{{ Storage::disk('public')->url($relatedProduct->thumbnail_path) }}" alt="{{ $relatedProduct->name }}" width="1200" height="1500" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="grid h-full place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.18),_transparent_44%),linear-gradient(180deg,_#262626_0%,_#171717_100%)] text-sm text-white/55">Product visual</div>
                                @endif
                            </a>
                            <div class="p-7">
                                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-champagne-dark">{{ $relatedProduct->category?->name ?? 'Product' }}</p>
                                <h3 class="mt-3 text-xl font-semibold leading-snug">{{ $relatedProduct->name }}</h3>
                                <a href="{{ route('products.show', $relatedProduct) }}" wire:navigate class="mt-5 inline-flex text-sm font-semibold text-champagne-dark transition hover:text-champagne-hover">View detail →</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
