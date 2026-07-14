@extends('layouts.app')

@section('title', __('site.team.title').' | '.$siteSettings->firm_name)
@section('meta_description', __('site.team.lead').' — '.$siteSettings->firm_name)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">{{ __('site.team.eyebrow') }}</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">{{ __('site.team.title') }}</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                {{ __('site.team.lead') }}
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @forelse ($members as $member)
                    <article class="surface-card surface-card-hover flex h-full flex-col text-center">
                        <a href="{{ route('team.show', $member) }}" class="group flex flex-1 flex-col">
                            @if ($member->photoUrl())
                                <x-firm-img
                                    :src="$member->photoUrl()"
                                    :alt="$member->name"
                                    width="176"
                                    height="176"
                                    class="mx-auto h-40 w-40 rounded-full object-cover ring-4 ring-surface-100 transition group-hover:ring-accent/30 sm:h-44 sm:w-44"
                                />
                            @else
                                <span class="mx-auto flex h-40 w-40 items-center justify-center rounded-full bg-primary font-display text-3xl font-bold text-surface-50 ring-4 ring-surface-100 transition group-hover:ring-accent/30 sm:h-44 sm:w-44">
                                    {{ collect(explode(' ', $member->name))->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('') }}
                                </span>
                            @endif
                            <h2 class="mt-5 font-display text-xl font-bold text-primary transition group-hover:text-primary-700">{{ $member->name }}</h2>
                            @if ($member->role)
                                <p class="mt-1 text-sm font-semibold uppercase tracking-[0.12em] text-accent-700">{{ $member->role }}</p>
                            @endif
                            <span class="btn-ghost mx-auto mt-5">
                                {{ __('site.cta.view_profile') }}
                                <span aria-hidden="true">→</span>
                            </span>
                        </a>
                    </article>
                @empty
                    <p class="text-surface-600 sm:col-span-2 lg:col-span-4">{{ __('site.team.empty') }}</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
