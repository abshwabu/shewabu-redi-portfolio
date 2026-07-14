@extends('layouts.error')

@section('title', __('site.errors.404_title').' | '.($siteSettings->firm_name ?? 'Shewabu Redi'))
@section('meta_description', __('site.errors.404_copy'))
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="section-shell w-full py-16 text-center sm:py-24">
        <p class="eyebrow">{{ __('site.errors.404_eyebrow') }}</p>
        <h1 class="mt-4 font-display text-4xl font-bold text-primary sm:text-5xl">{{ __('site.errors.404_title') }}</h1>
        <p class="mx-auto mt-5 max-w-xl text-base leading-relaxed text-surface-600">
            {{ __('site.errors.404_copy') }}
        </p>
        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="{{ route('home') }}" class="btn-primary min-h-12 w-full sm:w-auto">{{ __('site.cta.back_home') }}</a>
            <a href="{{ route('contact') }}" class="inline-flex min-h-12 w-full items-center justify-center border border-primary px-5 py-3 text-sm font-semibold text-primary transition hover:bg-primary-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent sm:w-auto">
                {{ __('site.cta.contact_us') }}
            </a>
        </div>
    </div>
@endsection
