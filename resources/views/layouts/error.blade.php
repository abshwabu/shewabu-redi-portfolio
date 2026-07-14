<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col font-sans text-surface-800 antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100] focus:bg-accent focus:px-4 focus:py-2 focus:text-primary focus:outline-none">
        {{ __('site.skip_to_main') }}
    </a>

    <header class="border-b border-surface-200 bg-surface-50">
        <div class="mx-auto flex h-16 max-w-7xl items-center px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ $siteSettings->firm_name ?? __('site.home_aria') }}">
                <span class="flex h-9 w-9 items-center justify-center bg-primary font-display text-sm font-bold text-accent-100">SR</span>
                <span class="font-display text-sm font-bold text-primary sm:text-base">Shewabu Redi</span>
            </a>
        </div>
    </header>

    <main id="main-content" class="flex flex-1 items-center">
        @yield('content')
    </main>

    <footer class="border-t border-surface-200 bg-surface-50 py-6 text-center text-sm text-surface-600">
        <p>&copy; {{ date('Y') }} {{ $siteSettings->firm_name ?? 'Shewabu Redi Mohammed Authorized Accounting Firm' }}</p>
    </footer>
</body>
</html>
