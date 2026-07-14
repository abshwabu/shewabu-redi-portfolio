@extends('layouts.error')

@section('title', 'Maintenance | '.($siteSettings->firm_name ?? 'Shewabu Redi'))
@section('meta_description', 'We are performing scheduled maintenance and will be back shortly.')
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="section-shell w-full py-16 text-center sm:py-24">
        <p class="eyebrow">Maintenance</p>
        <h1 class="mt-4 font-display text-4xl font-bold text-primary sm:text-5xl">We will be back soon</h1>
        <p class="mx-auto mt-5 max-w-xl text-base leading-relaxed text-surface-600">
            {{ $exception?->getMessage() && $exception->getMessage() !== 'Service Unavailable'
                ? $exception->getMessage()
                : 'Our website is temporarily unavailable while we perform scheduled maintenance. Please check back shortly or reach us by phone or email.' }}
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
        <a href="{{ route('home') }}" class="btn-primary mt-10 inline-flex min-h-12">Try again</a>
    </div>
@endsection
