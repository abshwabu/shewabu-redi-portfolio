@extends('layouts.error')

@section('title', __('site.errors.503_title').' | '.($siteSettings->firm_name ?? 'Shewabu Redi'))
@section('meta_description', __('site.errors.503_copy'))
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="section-shell w-full py-16 text-center sm:py-24">
        <p class="eyebrow">{{ __('site.errors.503_eyebrow') }}</p>
        <h1 class="mt-4 font-display text-4xl font-bold text-primary sm:text-5xl">{{ __('site.errors.503_title') }}</h1>
        <p class="mx-auto mt-5 max-w-xl text-base leading-relaxed text-surface-600">
            {{ $exception?->getMessage() && $exception->getMessage() !== 'Service Unavailable'
                ? $exception->getMessage()
                : __('site.errors.503_copy') }}
        </p>
        @if (filled($siteSettings->phone ?? null) || filled($siteSettings->email ?? null))
            <ul class="mx-auto mt-8 max-w-md space-y-2 text-sm text-surface-700">
                @if ($siteSettings->phone ?? null)
                    <li>
                        <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->phone) }}" class="font-semibold text-primary hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            {{ $siteSettings->phone }}
                        </a>
                    </li>
                @endif
                @if ($siteSettings->email ?? null)
                    <li>
                        <a href="mailto:{{ $siteSettings->email }}" class="font-semibold text-primary hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">
                            {{ $siteSettings->email }}
                        </a>
                    </li>
                @endif
            </ul>
        @endif
        <a href="{{ route('home') }}" class="btn-primary mt-10 inline-flex min-h-12">{{ __('site.cta.try_again') }}</a>
    </div>
@endsection
