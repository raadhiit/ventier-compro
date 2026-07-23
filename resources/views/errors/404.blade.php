<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page not found</title>
        <meta name="description" content="The requested page could not be found.">
        <link rel="icon" href="{{ asset('icon/logo.png') }}?v=3" type="image/png">
        <link rel="apple-touch-icon" href="{{ asset('icon/logo.png') }}?v=3">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fonts
    </head>
    <body class="public-site min-h-screen bg-brand-black text-white">
        <section class="flex min-h-screen items-center px-5 py-24">
            <div class="mx-auto w-full max-w-7xl">
                <p class="text-xs font-semibold uppercase tracking-[0.38em] text-champagne">Error 404</p>
                <h1 class="mt-5 max-w-4xl text-5xl font-semibold leading-[1] tracking-[-0.04em] sm:text-7xl">This road ends here.</h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-white/65">The page may have moved or no longer exists. Continue through our public catalog or return home.</p>
                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="rounded-full bg-brand-orange px-7 py-3 text-sm font-semibold text-brand-black transition hover:bg-brand-orange-soft">Return home</a>
                    <a href="{{ route('products.index') }}" class="rounded-full border border-white/20 px-7 py-3 text-sm font-semibold text-white transition hover:border-champagne hover:text-champagne">Browse products</a>
                </div>
            </div>
        </section>
    </body>
</html>
