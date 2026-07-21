@php
    $brandName = $siteSettings['brand_name'];
    $logo = $siteSettings['logo'] ?? null;
    $navigationItems = [
        [
            'label' => 'Home',
            'route' => 'home',
            'active' => 'home',
        ],
        [
            'label' => 'Products',
            'route' => 'products.index',
            'active' => 'products.*',
        ],
        [
            'label' => 'About',
            'route' => 'about',
            'active' => 'about',
        ],
        [
            'label' => 'Contact',
            'route' => 'contact',
            'active' => 'contact',
        ],
    ];
@endphp

<header
    x-data="{
        open: false,
        scrolled: window.scrollY > 24,
        overlay: @js(request()->routeIs('home')),
        closeMenu() {
            this.open = false;
            document.body.classList.remove('overflow-hidden');
        },
        toggleMenu() {
            this.open = ! this.open;
            document.body.classList.toggle('overflow-hidden', this.open);
        },
    }"
    x-on:scroll.window="scrolled = window.scrollY > 24"
    x-on:keydown.escape.window="closeMenu()"
    x-on:livewire:navigating.window="closeMenu()"
    :class="! overlay || scrolled || open ? 'bg-brand-carbon/95 backdrop-blur-md' : 'bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 border-b border-white/10 transition-colors duration-300"
>
    <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-10" aria-label="Primary navigation">
        <a href="{{ route('home') }}" wire:navigate class="relative z-50 flex items-center" aria-label="{{ $brandName }} home">
            @if ($logo)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($logo) }}"
                    alt="{{ $brandName }}"
                    width="160"
                    height="40"
                    class="h-8 w-auto object-contain md:h-10"
                >
            @else
                <span class="text-xl font-semibold tracking-[0.2em] text-white uppercase">
                    {{ $brandName }}
                </span>
            @endif
        </a>

        <div class="hidden items-center gap-8 md:flex">
            @foreach ($navigationItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    wire:navigate
                    @if (request()->routeIs($item['active'])) aria-current="page" @endif
                    @class([
                        'relative py-2 text-sm font-medium tracking-wide transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne focus-visible:ring-offset-2 focus-visible:ring-offset-brand-carbon',
                        'text-champagne' => request()->routeIs($item['active']),
                        'text-white/80 hover:text-white' => ! request()->routeIs($item['active']),
                    ])
                >
                    {{ $item['label'] }}

                    @if (request()->routeIs($item['active']))
                        <span class="absolute inset-x-0 -bottom-0.5 h-px bg-champagne" aria-hidden="true"></span>
                    @endif
                </a>
            @endforeach
        </div>

        <button
            type="button"
            class="relative z-50 inline-flex size-11 items-center justify-center text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne md:hidden"
            x-on:click="toggleMenu()"
            :aria-expanded="open"
            aria-controls="mobile-navigation"
            :aria-label="open ? 'Close navigation' : 'Open navigation'"
        >
            <svg x-show="! open" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16" />
            </svg>

            <svg x-cloak x-show="open" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>
    </nav>

    <div class="border-t border-white/10 md:hidden">
        <div class="mx-auto flex max-w-7xl gap-4 overflow-x-auto px-6 py-3 text-sm text-white/75 md:hidden">
            @foreach ($navigationItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    wire:navigate
                    @if (request()->routeIs($item['active'])) aria-current="page" @endif
                    @class([
                        'shrink-0 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne',
                        'text-champagne' => request()->routeIs($item['active']),
                        'hover:text-white' => ! request()->routeIs($item['active']),
                    ])
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    <div
        id="mobile-navigation"
        x-cloak
        x-show="open"
        x-transition.opacity.duration.300ms
        class="fixed inset-0 min-h-svh bg-brand-carbon px-6 pt-28 md:hidden"
        aria-label="Mobile navigation"
    >
        <nav class="flex flex-col" aria-label="Mobile primary navigation">
            @foreach ($navigationItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    wire:navigate
                    x-on:click="closeMenu()"
                    @if (request()->routeIs($item['active'])) aria-current="page" @endif
                    @class([
                        'border-b border-white/10 py-6 text-3xl font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne',
                        'text-champagne' => request()->routeIs($item['active']),
                        'text-white hover:text-champagne' => ! request()->routeIs($item['active']),
                    ])
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </div>
</header>
