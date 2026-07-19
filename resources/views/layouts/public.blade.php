<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
    </head>
    <body class="font-sans antialiased bg-surface-warm text-text-primary" x-data="{ scrolled: false, home: {{ request()->routeIs('home') ? 'true' : 'false' }} }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)">
        <nav class="fixed top-0 inset-x-0 z-50 h-14 flex items-center transition-all duration-300" :class="home ? (scrolled ? 'bg-surface-warm/95 backdrop-blur-md border-b border-black/8 text-text-primary' : 'bg-transparent text-white') : 'bg-surface-warm/95 backdrop-blur-md border-b border-black/8 text-text-primary'">
            <div class="max-w-[1262px] mx-auto w-full px-5 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight transition-colors">Vantier</a>
                <div class="flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="transition-colors" :class="home && !scrolled ? 'hover:text-white/70' : 'hover:text-text-secondary'">Home</a>
                    <a href="{{ route('products.index') }}" class="transition-colors" :class="home && !scrolled ? 'hover:text-white/70' : 'hover:text-text-secondary'">Product</a>
                    <a href="{{ route('about') }}" class="transition-colors" :class="home && !scrolled ? 'hover:text-white/70' : 'hover:text-text-secondary'">About Us</a>
                    <a href="{{ route('contact') }}" class="transition-colors" :class="home && !scrolled ? 'hover:text-white/70' : 'hover:text-text-secondary'">Contact</a>
                </div>
            </div>
        </nav>
        <main>
            {{ $slot }}
        </main>
        <footer class="bg-brand-black text-white py-16 px-5">
            <div class="max-w-[1262px] mx-auto grid gap-10 md:grid-cols-4">
                <div>
                    <h4 class="font-semibold text-sm text-white/80 mb-4 uppercase tracking-wider">Ventier</h4>
                    <p class="text-sm text-white/40 leading-relaxed">Furnitur premium untuk kenyamanan berkendara Anda.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-white/80 mb-4 uppercase tracking-wider">Products</h4>
                    <ul class="space-y-2 text-sm text-white/40">
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">All Products</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-white/80 mb-4 uppercase tracking-wider">Information</h4>
                    <ul class="space-y-2 text-sm text-white/40">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-white/80 mb-4 uppercase tracking-wider">Follow Us</h4>
                    <p class="text-sm text-white/40">Stay connected for updates and new products.</p>
                </div>
            </div>
            <div class="max-w-[1262px] mx-auto mt-12 pt-8 border-t border-white/10 text-sm text-white/40 text-center">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </footer>
    </body>
</html>
