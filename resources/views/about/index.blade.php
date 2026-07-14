@extends('layouts.app')

@section('title', __('site.nav.about').' | '.$siteSettings->firm_name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($siteSettings->t('about_excerpt') ?: $siteSettings->seo_description), 155))

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_10%,rgba(201,162,39,0.22),transparent_40%),linear-gradient(160deg,#0B2545,#15334E)]"></div>
        <div class="section-shell relative py-16 sm:py-20 lg:py-24">
            <p class="eyebrow text-accent-200">{{ __('site.about.eyebrow') }}</p>
            <h1 class="mt-4 max-w-3xl font-display text-4xl font-bold sm:text-5xl">{{ $settings->firm_name }}</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                {{ $settings->t('tagline') ?: __('site.about.tagline_fallback') }}
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
            <div>
                <p class="eyebrow">{{ __('site.about.story_eyebrow') }}</p>
                <h2 class="section-title">{{ __('site.about.story_title') }}</h2>
                <div class="mt-6 space-y-4 text-base leading-relaxed text-surface-700">
                    @foreach (preg_split('/\n+/', trim($settings->t('about_excerpt') ?: __('site.about.story_empty'))) as $paragraph)
                        @if (filled(trim($paragraph)))
                            <p>{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <aside class="surface-card border-l-4 border-l-accent bg-white">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">{{ __('site.about.at_glance') }}</p>
                <ul class="mt-5 space-y-4 text-sm text-surface-700">
                    <li class="flex justify-between gap-4 border-b border-surface-100 pb-3">
                        <span>{{ __('site.about.location') }}</span>
                        <span class="font-semibold text-primary">{{ collect([$settings->city, $settings->country])->filter()->implode(', ') ?: __('site.about.location_fallback') }}</span>
                    </li>
                    <li class="flex justify-between gap-4 border-b border-surface-100 pb-3">
                        <span>{{ __('site.contact.email') }}</span>
                        <a href="mailto:{{ $settings->email }}" class="font-semibold text-primary hover:text-accent">{{ $settings->email }}</a>
                    </li>
                    <li class="flex justify-between gap-4">
                        <span>{{ __('site.team.phone') }}</span>
                        <a href="tel:{{ preg_replace('/\s+/', '', (string) $settings->phone) }}" class="font-semibold text-primary hover:text-accent">{{ $settings->phone }}</a>
                    </li>
                </ul>
            </aside>
        </div>
    </section>

    <section class="section-pad bg-white">
        <div class="section-shell grid gap-6 lg:grid-cols-2">
            <article class="surface-card h-full bg-primary text-surface-50 shadow-card">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">{{ __('site.about.mission_title') }}</p>
                <h2 class="mt-4 font-display text-2xl font-bold">{{ __('site.about.mission_heading') }}</h2>
                <p class="mt-5 text-base leading-relaxed text-primary-100">
                    {{ $settings->t('mission') ?: __('site.about.mission_fallback') }}
                </p>
            </article>
            <article class="surface-card h-full border-accent/30">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">{{ __('site.about.vision_title') }}</p>
                <h2 class="mt-4 font-display text-2xl font-bold text-primary">{{ __('site.about.vision_heading') }}</h2>
                <p class="mt-5 text-base leading-relaxed text-surface-600">
                    {{ $settings->t('vision') ?: __('site.about.vision_fallback') }}
                </p>
            </article>
        </div>
    </section>

    <section class="section-pad bg-surface-100">
        <div class="section-shell">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">{{ __('site.about.team_eyebrow') }}</p>
                    <h2 class="section-title">{{ __('site.about.team_title') }}</h2>
                    <p class="section-lead">{{ __('site.about.team_lead') }}</p>
                </div>
                <a href="{{ route('team.index') }}" class="btn-ghost shrink-0">
                    {{ __('site.cta.view_full_team') }}
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($teamPreview as $member)
                    <article class="surface-card surface-card-hover text-center">
                        @if ($member->photoUrl())
                            <x-firm-img
                                :src="$member->photoUrl()"
                                :alt="$member->name"
                                width="96"
                                height="96"
                                class="mx-auto h-24 w-24 rounded-full object-cover shadow-card"
                            />
                        @else
                            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-primary font-display text-xl font-bold text-accent shadow-card">
                                {{ collect(explode(' ', $member->name))->map(fn ($p) => mb_substr($p, 0, 1))->take(2)->implode('') }}
                            </div>
                        @endif
                        <h3 class="mt-5 font-display text-lg font-bold text-primary">{{ $member->name }}</h3>
                        <p class="mt-1 text-sm font-medium text-accent-700">{{ $member->role }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-primary text-surface-50">
        <div class="section-shell flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-display text-3xl font-bold">{{ __('site.about.engage_title') }}</h2>
                <p class="mt-3 max-w-xl text-primary-100">{{ __('site.about.engage_copy') }}</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-primary shrink-0">{{ __('site.cta.contact_firm') }}</a>
        </div>
    </section>
@endsection
