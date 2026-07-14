@php
    $navLinks = [
        ['label' => __('site.nav.home'), 'route' => 'home'],
        ['label' => __('site.nav.about'), 'route' => 'about'],
        ['label' => __('site.nav.services'), 'route' => 'services.index'],
        ['label' => __('site.nav.industries'), 'route' => 'industries'],
        ['label' => __('site.nav.insights'), 'route' => 'insights.index'],
        ['label' => __('site.nav.contact'), 'route' => 'contact'],
    ];
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 8 })"
    @keydown.escape.window="open = false"
    class="sticky top-0 z-50 border-b transition-colors duration-300"
    :class="scrolled || open ? 'border-surface-200 bg-surface-50/95 backdrop-blur-md shadow-sm' : 'border-transparent bg-surface-50'"
>
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:h-[4.5rem] lg:gap-4 lg:px-8">
        <a href="{{ route('home') }}" class="group flex min-w-0 shrink-0 items-center gap-3" aria-label="{{ __('site.home_aria') }}">
            <span class="flex h-9 w-9 items-center justify-center bg-primary text-sm font-display font-bold tracking-wide text-accent-100 sm:h-10 sm:w-10">
                SR
            </span>
            <span class="min-w-0">
                <span class="block truncate font-display text-sm font-bold leading-tight text-primary sm:text-base">
                    Shewabu Redi
                </span>
                <span class="hidden truncate text-[0.65rem] font-medium uppercase tracking-[0.12em] text-surface-500 sm:block">
                    {{ __('site.brand.authorized_firm') }}
                </span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
            @foreach ($navLinks as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @class([
                        'px-3 py-2 text-sm font-semibold tracking-wide transition-colors duration-200',
                        'text-primary border-b-2 border-accent' => request()->routeIs($link['route']) || (str_starts_with($link['route'], 'services') && request()->routeIs('services.*')) || ($link['route'] === 'insights.index' && request()->routeIs('insights.*')),
                        'text-surface-600 hover:text-primary' => ! (request()->routeIs($link['route']) || (str_starts_with($link['route'], 'services') && request()->routeIs('services.*')) || ($link['route'] === 'insights.index' && request()->routeIs('insights.*'))),
                    ])
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
            @include('partials.language-toggle')

            <a
                href="{{ route('contact') }}"
                class="hidden items-center bg-primary px-4 py-2.5 text-sm font-semibold text-surface-50 transition-colors duration-200 hover:bg-primary-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent lg:inline-flex"
            >
                {{ __('site.cta.get_in_touch') }}
            </a>

            <button
                type="button"
                class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-md p-2 text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent lg:hidden"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="mobile-nav"
                aria-label="{{ __('site.toggle_nav') }}"
            >
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg x-cloak x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div
        id="mobile-nav"
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="border-t border-surface-200 bg-surface-50 lg:hidden"
        @click.outside="open = false"
    >
        <nav class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-4 sm:px-6" aria-label="Mobile">
            @foreach ($navLinks as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @click="open = false"
                    @class([
                        'min-h-11 px-3 py-3 text-base font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-accent',
                        'bg-primary-50 text-primary border-l-2 border-accent' => request()->routeIs($link['route']) || (str_starts_with($link['route'], 'services') && request()->routeIs('services.*')),
                        'text-surface-700 hover:bg-surface-100 hover:text-primary' => ! (request()->routeIs($link['route']) || (str_starts_with($link['route'], 'services') && request()->routeIs('services.*'))),
                    ])
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a
                href="{{ route('contact') }}"
                @click="open = false"
                class="mt-2 inline-flex min-h-11 items-center justify-center bg-primary px-4 py-3 text-sm font-semibold text-surface-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
            >
                {{ __('site.cta.get_in_touch') }}
            </a>
        </nav>
    </div>
</header>

<style>[x-cloak]{display:none!important}</style>
