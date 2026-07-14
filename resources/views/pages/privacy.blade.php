@extends('layouts.app')

@section('title', 'Privacy Policy | '.$settings->firm_name)
@section('meta_description', 'Privacy policy for '.$settings->firm_name.'.')
@section('robots', 'noindex,follow')

@section('content')
    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            <p class="eyebrow">Legal</p>
            <h1 class="section-title">Privacy Policy</h1>
            <article class="surface-card mt-10 prose-firm text-surface-700">
                @if (filled($settings->privacy_body))
                    {!! $settings->privacy_body !!}
                @else
                    <p>Privacy policy content can be managed from the admin settings panel.</p>
                @endif
            </article>
        </div>
    </section>
@endsection
