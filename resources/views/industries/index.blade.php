@extends('layouts.app')

@section('title', ($settings->industries_heading ?: 'Industries').' | '.$settings->firm_name)
@section('meta_description', $settings->industries_intro ?: $settings->seo_description)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">Sectors</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">{{ $settings->industries_heading ?: 'Industries we serve' }}</h1>
            @if ($settings->industries_intro)
                <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">{{ $settings->industries_intro }}</p>
            @endif
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            @if (filled($settings->industries_body))
                <article class="surface-card prose-firm text-surface-700">
                    {!! $settings->industries_body !!}
                </article>
            @else
                <p class="text-surface-600">Industry content can be managed from the admin settings panel.</p>
            @endif
        </div>
    </section>
@endsection
