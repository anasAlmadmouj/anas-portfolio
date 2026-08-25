<!doctype html>
<html lang="{{ $locale }}" dir="{{ $textDirection }}">
<head>
    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var theme = stored || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
                document.documentElement.style.colorScheme = theme;
            } catch (e) {}
        })();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', __('general.meta_description'))">
    <title>@yield('title', __('general.site_name').' — '.__('general.site_role'))</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

    @php
        $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteName();
        $currentRouteParams = $currentRouteName ? request()->route()->parameters() : [];
    @endphp

    @if($currentRouteName)
        <link rel="canonical" href="{{ route($currentRouteName, [...$currentRouteParams, 'locale' => $locale]) }}">
        <link rel="alternate" hreflang="en" href="{{ route($currentRouteName, [...$currentRouteParams, 'locale' => 'en']) }}">
        <link rel="alternate" hreflang="ar" href="{{ route($currentRouteName, [...$currentRouteParams, 'locale' => 'ar']) }}">
        <link rel="alternate" hreflang="x-default" href="{{ route($currentRouteName, [...$currentRouteParams, 'locale' => 'en']) }}">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ __('general.site_name') }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_AR' : 'en_US' }}">
    @if($currentRouteName)
        <meta property="og:url" content="{{ route($currentRouteName, [...$currentRouteParams, 'locale' => $locale]) }}">
    @endif
    <meta property="og:title" content="@yield('title', __('general.site_name').' — '.__('general.site_role'))">
    <meta property="og:description" content="@yield('meta_description', __('general.meta_description'))">
    @if($hasOgImage)
        <meta property="og:image" content="{{ asset(config('portfolio.og_image_path')) }}">
    @endif

    <meta name="twitter:card" content="{{ $hasOgImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="@yield('title', __('general.site_name').' — '.__('general.site_role'))">
    <meta name="twitter:description" content="@yield('meta_description', __('general.meta_description'))">
    @if($hasOgImage)
        <meta name="twitter:image" content="{{ asset(config('portfolio.og_image_path')) }}">
    @endif

    <script type="application/ld+json">{!! $personJsonLd !!}</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if($locale === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Readex+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    <div class="scroll-progress" id="scroll-progress" aria-hidden="true"></div>
    <a href="#main-content" class="skip-link">{{ __('general.skip_to_content') }}</a>

    <x-navigation.navbar />

    <main id="main-content">
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
