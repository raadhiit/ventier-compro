<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >

        @php
            $brandName = $siteSettings['brand_name'];
            $pageTitle = filled($title ?? null)
                ? $title
                : $siteSettings['default_seo_title'];
            $pageDescription = filled($description ?? null)
                ? $description
                : $siteSettings['default_seo_description'];
            $pageOgImage = filled($image ?? null)
                ? $image
                : ($siteSettings['default_og_image'] ?? null);
            $canonicalUrl = filled($canonical ?? null)
                ? $canonical
                : url()->current();
            $ogImageUrl = $pageOgImage
                ? \Illuminate\Support\Str::startsWith($pageOgImage, ['http://', 'https://'])
                    ? $pageOgImage
                    : \Illuminate\Support\Facades\Storage::disk('public')->url($pageOgImage)
                : null;
        @endphp

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $pageDescription }}">
        <link rel="icon" href="{{ asset('icon/logo.png') }}?v=3" type="image/png">
        <link rel="apple-touch-icon" href="{{ asset('icon/logo.png') }}?v=3">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <meta property="og:site_name" content="{{ $brandName }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription }}">
        <meta property="og:type" content="{{ $ogType ?? 'website' }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">

        @if ($ogImageUrl)
            <meta property="og:image" content="{{ $ogImageUrl }}">
        @endif

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $pageDescription }}">

        @if ($ogImageUrl)
            <meta name="twitter:image" content="{{ $ogImageUrl }}">
        @endif

        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
        ])

        @fonts
    </head>

    <body class="public-site min-h-screen">
        @include('partials.public-navbar')

        <main
            @class([
                'relative z-10 min-h-screen',
                'pt-20' => ! request()->routeIs('home'),
            ])
        >
            {{ $slot }}
        </main>

        @include('partials.public-footer')
    </body>
</html>