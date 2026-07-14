@extends('layouts.app')

@section('title', $service->meta_title ?: ($service->title.' | Shewabu Redi Mohammed Authorized Accounting Firm'))
@section('meta_description', $service->meta_description ?: $service->summary)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(201,162,39,0.2),transparent_35%),linear-gradient(145deg,#0B2545,#15334E)]"></div>
        <div class="section-shell relative py-14 sm:py-18 lg:py-20">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary-100 transition hover:text-accent">
                <span aria-hidden="true">←</span> All services
            </a>
            @if ($service->category)
                <p class="eyebrow mt-6 text-accent-200">{{ $service->category }}</p>
            @endif
            <h1 class="mt-4 max-w-3xl font-display text-4xl font-bold sm:text-5xl">{{ $service->title }}</h1>
            @if ($service->summary)
                <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">{{ $service->summary }}</p>
            @endif
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell grid gap-10 lg:grid-cols-[1.4fr_0.8fr] lg:items-start">
            <article class="surface-card">
                @if ($service->imageUrl())
                    <img src="{{ $service->imageUrl() }}" alt="" class="mb-8 h-64 w-full rounded-lg object-cover sm:h-80">
                @endif
                <div class="prose-firm text-surface-700">
                    {!! $service->body !!}
                </div>
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28">
                <div class="surface-card border-accent/25 bg-primary text-surface-50">
                    <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">Engage us</p>
                    <h2 class="mt-3 font-display text-2xl font-bold">Need this service?</h2>
                    <p class="mt-3 text-sm leading-relaxed text-primary-100">Share your timeline and reporting requirements — we will propose a clear scope and next step.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-6 w-full">Contact the firm</a>
                </div>
            </aside>
        </div>
    </section>

    @if ($relatedServices->isNotEmpty())
        <section class="section-pad bg-white">
            <div class="section-shell">
                <p class="eyebrow">Continue exploring</p>
                <h2 class="section-title">Related services</h2>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedServices as $related)
                        <article class="surface-card surface-card-hover flex h-full flex-col">
                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary-50 text-primary">
                                @include('partials.service-icon', ['icon' => $related->icon, 'class' => 'h-5 w-5'])
                            </div>
                            <h3 class="mt-4 font-display text-lg font-bold text-primary">{{ $related->title }}</h3>
                            <p class="mt-2 flex-1 text-sm text-surface-600">{{ $related->summary }}</p>
                            <a href="{{ route('services.show', $related) }}" class="btn-ghost mt-5">
                                Learn more
                                <span aria-hidden="true">→</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
