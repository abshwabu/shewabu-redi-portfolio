@extends('layouts.error')

@section('title', 'Page not found | '.($siteSettings->firm_name ?? 'Shewabu Redi'))
@section('meta_description', 'The page you requested could not be found.')
@section('robots', 'noindex,nofollow')

@section('content')
    <div class="section-shell w-full py-16 text-center sm:py-24">
        <p class="eyebrow">Error 404</p>
        <h1 class="mt-4 font-display text-4xl font-bold text-primary sm:text-5xl">Page not found</h1>
        <p class="mx-auto mt-5 max-w-xl text-base leading-relaxed text-surface-600">
            The page you are looking for may have moved or no longer exists. Try the links below or contact our team for assistance.
        </p>
        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="{{ route('home') }}" class="btn-primary min-h-12 w-full sm:w-auto">Back to home</a>
            <a href="{{ route('contact') }}" class="inline-flex min-h-12 w-full items-center justify-center border border-primary px-5 py-3 text-sm font-semibold text-primary transition hover:bg-primary-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent sm:w-auto">
                Contact us
            </a>
        </div>
    </div>
@endsection
