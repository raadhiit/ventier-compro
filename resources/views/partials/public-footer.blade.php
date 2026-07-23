@php
    $brandName = $siteSettings['brand_name'];
    $footerDescription = $siteSettings['footer_description'];
    $logo = $siteSettings['logo_dark'] ?? $siteSettings['logo'] ?? null;
    $email = filled($siteSettings['email'] ?? null) ? $siteSettings['email'] : null;
    $instagramUrl = filled($siteSettings['instagram_url'] ?? null) ? $siteSettings['instagram_url'] : null;
    $address = filled($siteSettings['address'] ?? null) ? $siteSettings['address'] : null;
    $navigationItems = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Products', 'route' => 'products.index'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];

    $whatsAppDigits = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? ''));

    if (str_starts_with($whatsAppDigits, '0')) {
        $whatsAppDigits = '62'.substr($whatsAppDigits, 1);
    }

    $whatsAppUrl = $whatsAppDigits !== '' ? 'https://wa.me/'.$whatsAppDigits : null;
@endphp

<footer class="relative z-20 border-t border-white/10 bg-brand-black">
    <div class="mx-auto grid max-w-7xl gap-12 px-6 py-16 md:grid-cols-2 lg:grid-cols-[1.4fr_0.8fr_1fr] lg:px-10">
        <div>
            @if ($logo)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($logo) }}"
                    alt="{{ $brandName }}"
                    width="160"
                    height="40"
                    class="h-8 w-auto object-contain"
                >
            @else
                <p class="text-xl font-semibold tracking-[0.2em] text-white uppercase">
                    {{ $brandName }}
                </p>
            @endif

            <p class="mt-5 max-w-md text-sm leading-7 text-white/60">
                {{ $footerDescription }}
            </p>
        </div>

        <div>
            <h2 class="text-xs font-semibold tracking-[0.2em] text-champagne uppercase">
                Navigation
            </h2>

            <div class="mt-5 flex flex-col gap-3 text-sm text-white/65">
                @foreach ($navigationItems as $item)
                    <a href="{{ route($item['route']) }}" wire:navigate class="transition-colors hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-xs font-semibold tracking-[0.2em] text-champagne uppercase">
                Contact
            </h2>

            <div class="mt-5 flex flex-col gap-3 text-sm text-white/65">
                @if ($whatsAppUrl)
                    <a href="{{ $whatsAppUrl }}" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">
                        WhatsApp
                    </a>
                @endif

                @if ($email)
                    <a href="mailto:{{ $email }}" class="transition-colors hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">
                        {{ $email }}
                    </a>
                @endif

                @if ($instagramUrl)
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne">
                        Instagram
                    </a>
                @endif

                @if ($address)
                    <address class="not-italic leading-6 text-white/55">
                        {{ $address }}
                    </address>
                @endif
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-6 text-xs text-white/45 md:flex-row md:items-center md:justify-between lg:px-10">
            <p>
                © {{ now()->year }} {{ $brandName }}. All rights reserved.
            </p>

            <p>
                Premium Couture Carmat
            </p>
        </div>
    </div>
</footer>
