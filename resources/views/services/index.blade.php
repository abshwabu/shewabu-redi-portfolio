@extends('layouts.app')

@section('title', __('site.services.title').' | '.$siteSettings->firm_name)
@section('meta_description', $siteSettings->seo_description)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">{{ __('site.services.eyebrow') }}</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">{{ __('site.services.title') }}</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                {{ __('site.services.lead') }}
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <article class="surface-card surface-card-hover flex h-full flex-col">
                    @if ($service->imageUrl())
                        <x-firm-img
                            :src="$service->imageUrl()"
                            :alt="$service->title"
                            width="640"
                            height="160"
                            class="mb-5 h-40 w-full rounded-lg object-cover"
                        />
                    @else
                        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-lg bg-primary-50 text-primary">
                            @include('partials.service-icon', ['icon' => $service->icon, 'class' => 'h-7 w-7'])
                        </div>
                    @endif
                    @if ($service->category)
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-accent">{{ $service->category }}</p>
                    @endif
                    <h2 class="mt-2 font-display text-xl font-bold text-primary">{{ $service->title }}</h2>
                    <p class="mt-3 flex-1 text-sm leading-relaxed text-surface-600">{{ $service->summary }}</p>
                    <a href="{{ route('services.show', $service) }}" class="btn-ghost mt-6">
                        {{ __('site.cta.learn_more') }}
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @empty
                <p class="text-surface-600 sm:col-span-2 lg:col-span-3">{{ __('site.services.empty') }}</p>
            @endforelse
        </div>
    </section>
@endsection
