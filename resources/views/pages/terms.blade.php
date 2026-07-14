@extends('layouts.app')

@section('title', __('site.legal.terms').' | '.$settings->firm_name)
@section('meta_description', __('site.legal.terms').' — '.$settings->firm_name)
@section('robots', 'noindex,follow')

@section('content')
    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            <p class="eyebrow">{{ __('site.legal.eyebrow') }}</p>
            <h1 class="section-title">{{ __('site.legal.terms') }}</h1>
            <article class="surface-card mt-10 prose-firm text-surface-700">
                @if (filled($settings->t('terms_body')))
                    {!! $settings->t('terms_body') !!}
                @else
                    <p>{{ __('site.legal.terms_empty') }}</p>
                @endif
            </article>
        </div>
    </section>
@endsection
