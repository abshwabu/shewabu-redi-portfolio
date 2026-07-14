@extends('layouts.app')

@section('title', $settings->seo_title ?: 'Home | Shewabu Redi Mohammed Authorized Accounting Firm')
@section('meta_description', $settings->seo_description ?: $settings->hero_subheading)

@section('content')
    {{-- Hero: full-bleed brand composition --}}
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0">
            @if ($settings->heroImageUrl())
                <img
                    src="{{ $settings->heroImageUrl() }}"
                    alt=""
                    class="h-full w-full object-cover opacity-45"
                >
            @else
                <div class="h-full w-full bg-[radial-gradient(circle_at_20%_20%,rgba(201,162,39,0.28),transparent_42%),linear-gradient(135deg,#0B2545_0%,#15334E_48%,#071828_100%)]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/85 to-primary/40"></div>
            <div class="pointer-events-none absolute -right-24 top-10 h-72 w-72 rounded-full bg-accent/20 blur-3xl"></div>
        </div>

        <div class="section-shell relative flex min-h-[78vh] flex-col justify-center py-20 lg:min-h-[86vh] lg:py-28">
            <p class="eyebrow fade-up text-accent-200">{{ $settings->firm_name }}</p>
            <h1 class="fade-up-delayed mt-5 max-w-3xl font-display text-4xl font-bold leading-tight text-surface-50 sm:text-5xl lg:text-6xl">
                {{ $settings->hero_heading ?: 'Professional accounting you can trust' }}
            </h1>
            <p class="fade-up-late mt-6 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                {{ $settings->hero_subheading }}
            </p>
            <div class="fade-up-late mt-10 flex flex-wrap gap-4">
                <a href="{{ url($settings->hero_cta_url ?: '/contact') }}" class="btn-primary">
                    {{ $settings->hero_cta_label ?: 'Get in Touch' }}
                </a>
                <a href="{{ route('services.index') }}" class="btn-secondary">
                    Explore services
                </a>
            </div>
        </div>
    </section>

    {{-- Our Services --}}
    <section class="section-pad bg-surface-50">
        <div class="section-shell">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="eyebrow">What we deliver</p>
                    <h2 class="section-title">Our Services</h2>
                    <p class="section-lead">Specialist support across tax, audit, accounting, and advisory — structured for clarity from first conversation to deliverable.</p>
                </div>
                <a href="{{ route('services.index') }}" class="btn-ghost shrink-0">
                    View all services
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredServices as $service)
                    <article class="surface-card surface-card-hover flex h-full flex-col">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary-50 text-primary">
                            @include('partials.service-icon', ['icon' => $service->icon])
                        </div>
                        <h3 class="mt-5 font-display text-xl font-bold text-primary">{{ $service->title }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-surface-600">{{ $service->summary }}</p>
                        <a href="{{ route('services.show', $service) }}" class="btn-ghost mt-6">
                            Learn more
                            <span aria-hidden="true">→</span>
                        </a>
                    </article>
                @empty
                    <p class="text-surface-600 sm:col-span-2 lg:col-span-3">Featured services will appear here once published in the admin panel.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="section-pad relative overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-y-0 right-0 w-1/3 bg-[radial-gradient(circle_at_center,rgba(201,162,39,0.12),transparent_70%)]"></div>
        <div class="section-shell relative">
            <p class="eyebrow">Why Shewabu Redi</p>
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-lead">Authorized practice standards, practical communication, and engagement discipline that busy leadership teams can rely on.</p>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['title' => 'Authorized expertise', 'copy' => 'Engagements grounded in professional standards and local regulatory fluency.', 'icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z'],
                    ['title' => 'Clear deliverables', 'copy' => 'Reports and advice written for decision-makers — precise, timely, and actionable.', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
                    ['title' => 'Partnership mindset', 'copy' => 'We stay close during filing seasons and growth moments, not only at year-end.', 'icon' => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
                    ['title' => 'Ethical diligence', 'copy' => 'Independence, confidentiality, and quality control sit at the centre of every assignment.', 'icon' => 'M12 3v2.25m6.364 1.386l-1.591 1.591M21 12h-2.25m-1.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z'],
                ] as $prop)
                    <article class="surface-card h-full">
                        <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-accent/15 text-accent-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $prop['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="mt-5 font-display text-lg font-bold text-primary">{{ $prop['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-surface-600">{{ $prop['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stats --}}
    @if (count($stats))
        <section class="border-y border-primary-800 bg-primary py-12 sm:py-14">
            <div class="section-shell grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="text-center lg:text-left">
                        <p class="font-display text-4xl font-bold text-accent sm:text-5xl">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-sm font-medium uppercase tracking-[0.12em] text-primary-100">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Testimonials carousel --}}
    @if ($testimonials->isNotEmpty())
        <section
            class="section-pad bg-surface-100"
            x-data="{
                active: 0,
                total: {{ $testimonials->count() }},
                startX: 0,
                next() { this.active = (this.active + 1) % this.total },
                prev() { this.active = (this.active - 1 + this.total) % this.total },
                go(i) { this.active = i },
                onStart(e) { this.startX = e.changedTouches[0].screenX },
                onEnd(e) {
                    const dx = e.changedTouches[0].screenX - this.startX;
                    if (Math.abs(dx) < 40) return;
                    dx < 0 ? this.next() : this.prev();
                }
            }"
        >
            <div class="section-shell">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="eyebrow">Client voice</p>
                        <h2 class="section-title">What clients say</h2>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-surface-300 bg-white text-primary transition hover:border-accent hover:text-accent" @click="prev()" aria-label="Previous testimonial">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                        </button>
                        <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-surface-300 bg-white text-primary transition hover:border-accent hover:text-accent" @click="next()" aria-label="Next testimonial">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                    </div>
                </div>

                <div
                    class="relative mt-10 overflow-hidden"
                    @touchstart.passive="onStart"
                    @touchend.passive="onEnd"
                >
                    <div
                        class="flex transition-transform duration-500 ease-out"
                        :style="`transform: translateX(-${active * 100}%)`"
                    >
                        @foreach ($testimonials as $testimonial)
                            <figure class="w-full shrink-0 px-0 sm:px-1">
                                <div class="surface-card mx-auto max-w-4xl border-accent/20 bg-white shadow-card">
                                    <div class="flex items-start gap-4">
                                        @if ($testimonial->photoUrl())
                                            <img src="{{ $testimonial->photoUrl() }}" alt="" class="h-14 w-14 rounded-full object-cover">
                                        @else
                                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary text-sm font-bold text-accent">
                                                {{ collect(explode(' ', $testimonial->client_name))->map(fn ($p) => mb_substr($p, 0, 1))->take(2)->implode('') }}
                                            </div>
                                        @endif
                                        <div>
                                            <blockquote class="font-display text-xl leading-relaxed text-primary sm:text-2xl">
                                                “{{ $testimonial->quote }}”
                                            </blockquote>
                                            <figcaption class="mt-6">
                                                <p class="font-semibold text-primary">{{ $testimonial->client_name }}</p>
                                                <p class="text-sm text-surface-500">
                                                    {{ collect([$testimonial->client_role, $testimonial->company])->filter()->implode(' · ') }}
                                                </p>
                                            </figcaption>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex justify-center gap-2">
                    @foreach ($testimonials as $index => $testimonial)
                        <button
                            type="button"
                            class="h-2.5 w-2.5 rounded-full transition"
                            :class="active === {{ $index }} ? 'bg-accent w-6' : 'bg-surface-300'"
                            @click="go({{ $index }})"
                            aria-label="Show testimonial {{ $index + 1 }}"
                        ></button>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Final CTA --}}
    <section class="section-pad bg-primary text-surface-50">
        <div class="section-shell grid gap-8 lg:grid-cols-[1.4fr_1fr] lg:items-center">
            <div>
                <p class="eyebrow text-accent">Next step</p>
                <h2 class="mt-3 font-display text-3xl font-bold sm:text-4xl">Ready for clearer books and stronger compliance?</h2>
                <p class="mt-4 max-w-xl text-primary-100">Tell us about your filing calendar, audit needs, or growth plans — we will respond with a focused next step.</p>
            </div>
            <div class="flex flex-wrap gap-4 lg:justify-end">
                <a href="{{ route('contact') }}" class="btn-primary">Book a consultation</a>
                <a href="{{ route('about') }}" class="btn-secondary">About the firm</a>
            </div>
        </div>
    </section>
@endsection
