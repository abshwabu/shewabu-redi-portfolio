<footer class="border-t border-primary-800 bg-primary text-surface-100">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center bg-accent font-display text-sm font-bold text-primary">
                        SR
                    </span>
                    <span>
                        <span class="block font-display text-base font-bold text-surface-50">Shewabu Redi</span>
                        <span class="block text-xs uppercase tracking-[0.1em] text-primary-200">Authorized Accounting Firm</span>
                    </span>
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-primary-100">
                    {{ $siteSettings->about_excerpt ? \Illuminate\Support\Str::limit($siteSettings->about_excerpt, 140) : 'Professional audit, taxation, accounting, and advisory services delivered with integrity and regulatory excellence.' }}
                </p>
            </div>

            <div>
                <h2 class="font-display text-sm font-bold uppercase tracking-[0.14em] text-accent">Quick Links</h2>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="text-primary-100 transition-colors hover:text-accent">About the Firm</a></li>
                    <li><a href="{{ route('team') }}" class="text-primary-100 transition-colors hover:text-accent">Our Team</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-primary-100 transition-colors hover:text-accent">Services</a></li>
                    <li><a href="{{ route('industries') }}" class="text-primary-100 transition-colors hover:text-accent">Industries</a></li>
                    <li><a href="{{ route('insights.index') }}" class="text-primary-100 transition-colors hover:text-accent">Insights</a></li>
                    <li><a href="{{ route('contact') }}" class="text-primary-100 transition-colors hover:text-accent">Contact</a></li>
                </ul>
            </div>

            <div>
                <h2 class="font-display text-sm font-bold uppercase tracking-[0.14em] text-accent">Services</h2>
                <ul class="mt-4 space-y-2.5 text-sm">
                    @forelse ($footerServices as $service)
                        <li>
                            <a href="{{ route('services.show', $service) }}" class="text-primary-100 transition-colors hover:text-accent">
                                {{ $service->title }}
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('services.index') }}" class="text-primary-100 transition-colors hover:text-accent">All services</a></li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="font-display text-sm font-bold uppercase tracking-[0.14em] text-accent">Contact</h2>
                <ul class="mt-4 space-y-3 text-sm text-primary-100">
                    <li class="flex gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span>{{ collect([$siteSettings->address, $siteSettings->city, $siteSettings->country])->filter()->implode(', ') ?: 'Addis Ababa, Ethiopia' }}</span>
                    </li>
                    @if ($siteSettings->phone)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->phone) }}" class="transition-colors hover:text-accent">{{ $siteSettings->phone }}</a>
                        </li>
                    @endif
                    @if ($siteSettings->email)
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <a href="mailto:{{ $siteSettings->email }}" class="transition-colors hover:text-accent">{{ $siteSettings->email }}</a>
                        </li>
                    @endif
                </ul>

                <div class="mt-6 flex items-center gap-3">
                    @if ($siteSettings->linkedin_url)
                        <a href="{{ $siteSettings->linkedin_url }}" class="inline-flex h-9 w-9 items-center justify-center border border-primary-600 text-primary-100 transition-colors hover:border-accent hover:text-accent" aria-label="LinkedIn" target="_blank" rel="noopener">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    @endif
                    @if ($siteSettings->facebook_url)
                        <a href="{{ $siteSettings->facebook_url }}" class="inline-flex h-9 w-9 items-center justify-center border border-primary-600 text-primary-100 transition-colors hover:border-accent hover:text-accent" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if ($siteSettings->twitter_url)
                        <a href="{{ $siteSettings->twitter_url }}" class="inline-flex h-9 w-9 items-center justify-center border border-primary-600 text-primary-100 transition-colors hover:border-accent hover:text-accent" aria-label="X (Twitter)" target="_blank" rel="noopener">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.727-8.835L1.254 2.25H8.08l4.251 5.632 5.913-5.632zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col gap-4 border-t border-primary-700 pt-8 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-primary-200">
                &copy; {{ date('Y') }} {{ $siteSettings->firm_name }}. All rights reserved.
            </p>
            <div class="flex gap-4 text-xs">
                <a href="{{ route('privacy') }}" class="text-primary-200 transition-colors hover:text-accent">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-primary-200 transition-colors hover:text-accent">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
