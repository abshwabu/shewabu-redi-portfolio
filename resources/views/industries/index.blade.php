@extends('layouts.app')

@section('title', ($settings->t('industries_heading') ?: __('site.industries.title_fallback')).' | '.$settings->firm_name)
@section('meta_description', $settings->t('industries_intro') ?: $settings->seo_description)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">{{ __('site.industries.eyebrow') }}</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">{{ $settings->t('industries_heading') ?: __('site.industries.title_fallback') }}</h1>
            @if ($settings->t('industries_intro'))
                <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">{{ $settings->t('industries_intro') }}</p>
            @endif
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            @if (filled($settings->t('industries_body')))
                <article class="surface-card prose-firm text-surface-700">
                    {!! $settings->t('industries_body') !!}
                </article>
            @else
                <p class="text-surface-600">{{ __('site.industries.empty') }}</p>
            @endif
        </div>
    </section>
@endsection
