@php
    $brandName = $siteSettings['brand_name'];
    $email = $siteSettings['email'] ?? null;
    $instagramUrl = $siteSettings['instagram_url'] ?? null;
    $address = $siteSettings['address'] ?? null;
    $whatsAppDigits = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? ''));

    if (str_starts_with($whatsAppDigits, '0')) {
        $whatsAppDigits = '62'.substr($whatsAppDigits, 1);
    }

    $whatsAppUrl = $whatsAppDigits !== '' ? 'https://wa.me/'.$whatsAppDigits : null;
@endphp

<div class="bg-surface-warm text-text-primary">
    <section class="relative overflow-hidden bg-brand-black px-5 pb-24 pt-28 text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_78%_16%,_rgba(217,145,98,0.22),_transparent_32%),linear-gradient(135deg,_#0B0B0B_0%,_#171717_60%,_#0B0B0B_100%)]"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.38em] text-brand-orange-soft">Contact {{ $brandName }}</p>
                    <h1 class="mt-6 max-w-4xl text-5xl font-semibold leading-[1] tracking-[-0.04em] sm:text-6xl">Start with product questions. Continue with the right fit.</h1>
                </div>
                <p class="max-w-xl text-base leading-8 text-white/65 lg:justify-self-end" data-reveal>Ask about product details, vehicle fitment, materials, or partnership needs. No cart, checkout, or account required.</p>
            </div>
        </div>
    </section>

    <section class="px-5 py-20">
        <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-[0.8fr_1.2fr]">
            <div>
                <div data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">Direct channels</p>
                    <h2 class="mt-5 text-4xl font-semibold leading-[1.05] tracking-[-0.03em]">Choose the easiest way to reach us.</h2>
                    <p class="mt-6 text-base leading-8 text-text-secondary">Contact details only appear when configured. The inquiry form remains available as a safe fallback.</p>
                </div>

                <div class="mt-10 divide-y divide-border-sand border-y border-border-sand" data-reveal>
                    @if($whatsAppUrl)
                        <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener noreferrer" class="grid gap-2 py-6 transition hover:bg-white/55 sm:grid-cols-[120px_1fr] sm:px-3">
                            <span class="text-xs font-semibold uppercase tracking-[0.24em] text-champagne-dark">WhatsApp</span>
                            <span class="font-semibold text-text-primary">Start product inquiry →</span>
                        </a>
                    @endif
                    @if($email)
                        <a href="mailto:{{ $email }}" class="grid gap-2 py-6 transition hover:bg-white/55 sm:grid-cols-[120px_1fr] sm:px-3">
                            <span class="text-xs font-semibold uppercase tracking-[0.24em] text-champagne-dark">Email</span>
                            <span class="break-all font-semibold text-text-primary">{{ $email }}</span>
                        </a>
                    @endif
                    @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="grid gap-2 py-6 transition hover:bg-white/55 sm:grid-cols-[120px_1fr] sm:px-3">
                            <span class="text-xs font-semibold uppercase tracking-[0.24em] text-champagne-dark">Instagram</span>
                            <span class="font-semibold text-text-primary">View latest updates →</span>
                        </a>
                    @endif
                    @if($address)
                        <div class="grid gap-2 py-6 sm:grid-cols-[120px_1fr] sm:px-3">
                            <span class="text-xs font-semibold uppercase tracking-[0.24em] text-champagne-dark">Address</span>
                            <address class="not-italic leading-7 text-text-secondary">{{ $address }}</address>
                        </div>
                    @endif
                    @if(! $whatsAppUrl && ! $email && ! $instagramUrl && ! $address)
                        <div class="py-6 text-sm leading-7 text-text-secondary">Direct contact channels are being updated. Use the form and the team will follow up.</div>
                    @endif
                </div>
            </div>

            <div class="rounded-[2rem] border border-border-sand bg-white p-6 shadow-[0_24px_80px_rgba(11,11,11,0.1)] sm:p-8 lg:p-10" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-champagne-dark">Inquiry form</p>
                <h2 class="mt-4 text-3xl font-semibold tracking-[-0.025em]">Tell us what you need.</h2>
                <p class="mt-3 text-sm leading-7 text-text-secondary">Fields marked required help the team respond with useful product guidance.</p>
                <div class="mt-8">
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </section>
</div>
