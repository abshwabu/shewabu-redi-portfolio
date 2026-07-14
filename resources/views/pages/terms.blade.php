@extends('layouts.app')

@section('title', 'Terms of Use | '.$settings->firm_name)
@section('meta_description', 'Terms of use for '.$settings->firm_name.'.')
@section('robots', 'noindex,follow')

@section('content')
    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            <p class="eyebrow">Legal</p>
            <h1 class="section-title">Terms of Use</h1>
            <article class="surface-card mt-10 prose-firm text-surface-700">
                @if (filled($settings->terms_body))
                    {!! $settings->terms_body !!}
                @else
                    <p>Terms of use content can be managed from the admin settings panel.</p>
                @endif
            </article>
        </div>
    </section>
@endsection
