<div class="bg-surface-warm text-text-primary">
    @if($sections->isEmpty())
        <section class="relative overflow-hidden bg-brand-black px-5 py-28 text-white">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_76%_18%,_rgba(183,154,99,0.22),_transparent_34%),linear-gradient(135deg,_#0B0B0B_0%,_#171717_58%,_#0B0B0B_100%)]"></div>
            <div class="relative mx-auto max-w-7xl">
                <div class="max-w-3xl" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.38em] text-champagne">About Vantier</p>
                    <h1 class="mt-6 text-5xl font-semibold leading-[1] tracking-[-0.04em] sm:text-6xl">Premium car mat brand, built around trust and product clarity.</h1>
                    <p class="mt-7 max-w-2xl text-base leading-8 text-white/68">Brand story content is being curated. You can still browse the catalog or contact the team for product guidance.</p>
                    <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft">Browse products</a>
                        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/18 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/45 hover:bg-white/8">Contact team</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        @foreach($sections as $section)
            @switch($section->section_key)
                @case('hero')
                    <section class="relative overflow-hidden bg-brand-black px-5 py-28 text-white">
                        @if($section->image_path)
                            <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title ?: 'About Vantier' }}" width="1600" height="1200" class="absolute inset-0 h-full w-full object-cover opacity-45">
                        @endif
                        <div class="absolute inset-0 bg-[linear-gradient(90deg,_rgba(11,11,11,0.94)_0%,_rgba(11,11,11,0.68)_55%,_rgba(11,11,11,0.34)_100%)]"></div>
                        <div class="relative mx-auto max-w-7xl" data-reveal>
                            <p class="text-xs font-semibold uppercase tracking-[0.38em] text-champagne">About Vantier</p>
                            @if($section->title)
                                <h1 class="mt-6 max-w-4xl text-5xl font-semibold leading-[1] tracking-[-0.04em] sm:text-6xl lg:text-7xl">{{ $section->title }}</h1>
                            @endif
                            @if($section->subtitle)
                                <p class="mt-7 max-w-2xl text-base leading-8 text-white/68 sm:text-lg">{{ $section->subtitle }}</p>
                            @endif
                        </div>
                    </section>
                    @break

                @case('story')
                    <section class="px-5 py-24">
                        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
                            <div data-reveal>
                                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">Brand story</p>
                                @if($section->title)
                                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] sm:text-5xl">{{ $section->title }}</h2>
                                @endif
                                @if($section->subtitle)
                                    <p class="mt-6 max-w-xl text-base leading-8 text-text-secondary">{{ $section->subtitle }}</p>
                                @endif
                                @if($section->content)
                                    <div class="mt-8 max-w-2xl text-base leading-8 text-text-secondary">{!! $section->content !!}</div>
                                @endif
                            </div>
                            <div class="overflow-hidden rounded-[2rem] border border-border-sand bg-brand-carbon shadow-[0_24px_80px_rgba(11,11,11,0.18)]" data-reveal>
                                @if($section->image_path)
                                    <img src="{{ Storage::disk('public')->url($section->image_path) }}" alt="{{ $section->title }}" width="1600" height="1200" loading="lazy" class="h-full min-h-[420px] w-full object-cover">
                                @else
                                    <div class="grid min-h-[420px] place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.2),_transparent_42%),linear-gradient(180deg,_#171717_0%,_#0B0B0B_100%)] p-10 text-center text-white">
                                        <p class="max-w-sm text-2xl font-semibold leading-tight">A focused company profile, not an online checkout.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                    @break

                @case('values')
                @case('advantages')
                    <section class="bg-brand-carbon px-5 py-24 text-white">
                        <div class="mx-auto max-w-7xl">
                            <div class="max-w-3xl" data-reveal>
                                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne">{{ $section->sectionLabel() }}</p>
                                @if($section->title)
                                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] sm:text-5xl">{{ $section->title }}</h2>
                                @endif
                                @if($section->subtitle)
                                    <p class="mt-6 text-base leading-8 text-white/62">{{ $section->subtitle }}</p>
                                @endif
                            </div>

                            @if($section->content)
                                <div class="mt-10 max-w-3xl text-base leading-8 text-white/68" data-reveal>{!! $section->content !!}</div>
                            @else
                                <div class="mt-12 grid gap-px overflow-hidden rounded-[2rem] border border-white/10 bg-white/10 md:grid-cols-3" data-reveal>
                                    <div class="bg-brand-carbon p-7">
                                        <p class="text-sm font-semibold text-champagne">01</p>
                                        <h3 class="mt-5 text-xl font-semibold">Product clarity</h3>
                                        <p class="mt-3 text-sm leading-7 text-white/55">Every section should help visitors understand product value faster.</p>
                                    </div>
                                    <div class="bg-brand-carbon p-7">
                                        <p class="text-sm font-semibold text-champagne">02</p>
                                        <h3 class="mt-5 text-xl font-semibold">Refined protection</h3>
                                        <p class="mt-3 text-sm leading-7 text-white/55">Visual direction stays premium, warm, and automotive-focused.</p>
                                    </div>
                                    <div class="bg-brand-carbon p-7">
                                        <p class="text-sm font-semibold text-champagne">03</p>
                                        <h3 class="mt-5 text-xl font-semibold">Easy inquiry</h3>
                                        <p class="mt-3 text-sm leading-7 text-white/55">The website guides users toward contact, not checkout.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                    @break

                @case('cta')
                    <section class="px-5 py-24">
                        <div class="mx-auto max-w-7xl overflow-hidden rounded-[2rem] bg-brand-black p-8 text-white sm:p-12 lg:p-16" data-reveal>
                            <div class="max-w-3xl">
                                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-brand-orange-soft">Next step</p>
                                @if($section->title)
                                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em] sm:text-5xl">{{ $section->title }}</h2>
                                @endif
                                @if($section->subtitle)
                                    <p class="mt-6 text-base leading-8 text-white/65">{{ $section->subtitle }}</p>
                                @endif
                                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                                    @if($section->cta_label && $section->cta_url)
                                        <a href="{{ $section->cta_url }}" class="inline-flex items-center justify-center rounded-full bg-brand-orange px-8 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft">{{ $section->cta_label }}</a>
                                    @endif
                                    <a href="{{ route('products.index') }}" wire:navigate class="inline-flex items-center justify-center rounded-full border border-white/18 px-8 py-3 text-sm font-semibold text-white transition hover:border-white/45 hover:bg-white/8">View products</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @break
            @endswitch
        @endforeach
    @endif
</div>
