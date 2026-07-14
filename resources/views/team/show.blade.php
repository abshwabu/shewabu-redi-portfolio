@extends('layouts.app')

@section('title', $member->name.' | Shewabu Redi Mohammed Authorized Accounting Firm')
@section('meta_description', strip_tags(\Illuminate\Support\Str::limit($member->bio ?? $member->role, 160)))

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(201,162,39,0.18),transparent_40%),linear-gradient(145deg,#0B2545,#15334E)]"></div>
        <div class="section-shell relative py-14 sm:py-18 lg:py-20">
            <a href="{{ route('team.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary-100 transition hover:text-accent">
                <span aria-hidden="true">←</span> All team members
            </a>
            <div class="mt-8 flex flex-col items-center gap-6 text-center sm:flex-row sm:text-left">
                @if ($member->photoUrl())
                    <img src="{{ $member->photoUrl() }}" alt="" class="h-36 w-36 shrink-0 rounded-full object-cover ring-4 ring-accent/40 sm:h-44 sm:w-44">
                @else
                    <span class="flex h-36 w-36 shrink-0 items-center justify-center rounded-full bg-accent font-display text-4xl font-bold text-primary ring-4 ring-accent/40 sm:h-44 sm:w-44">
                        {{ collect(explode(' ', $member->name))->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('') }}
                    </span>
                @endif
                <div>
                    <h1 class="font-display text-4xl font-bold sm:text-5xl">{{ $member->name }}</h1>
                    @if ($member->role)
                        <p class="mt-3 text-lg font-semibold uppercase tracking-[0.12em] text-accent-200">{{ $member->role }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell grid gap-10 lg:grid-cols-[1.4fr_0.8fr] lg:items-start">
            <article class="surface-card">
                @if (filled($member->bio))
                    <div class="prose-firm text-surface-700">
                        {!! $member->bio !!}
                    </div>
                @else
                    <p class="text-surface-600">Profile details will be added soon.</p>
                @endif
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28">
                <div class="surface-card">
                    <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">Contact</p>
                    <ul class="mt-4 space-y-4 text-sm text-surface-700">
                        @if ($member->email)
                            <li>
                                <span class="block text-xs font-semibold uppercase tracking-[0.1em] text-surface-500">Email</span>
                                <a href="mailto:{{ $member->email }}" class="mt-1 inline-flex min-h-11 items-center font-semibold text-primary transition hover:text-accent">{{ $member->email }}</a>
                            </li>
                        @endif
                        @if ($member->phone)
                            <li>
                                <span class="block text-xs font-semibold uppercase tracking-[0.1em] text-surface-500">Phone</span>
                                <a href="tel:{{ preg_replace('/\s+/', '', $member->phone) }}" class="mt-1 inline-flex min-h-11 items-center font-semibold text-primary transition hover:text-accent">{{ $member->phone }}</a>
                            </li>
                        @endif
                        @if ($member->linkedin_url)
                            <li>
                                <span class="block text-xs font-semibold uppercase tracking-[0.1em] text-surface-500">LinkedIn</span>
                                <a href="{{ $member->linkedin_url }}" class="mt-1 inline-flex min-h-11 items-center font-semibold text-primary transition hover:text-accent" target="_blank" rel="noopener noreferrer">
                                    View profile
                                    <span class="sr-only">(opens in new tab)</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="surface-card border-accent/25 bg-primary text-surface-50">
                    <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">Work with us</p>
                    <p class="mt-3 text-sm leading-relaxed text-primary-100">Discuss your audit, tax, or advisory needs with our team.</p>
                    <a href="{{ route('contact') }}" class="btn-primary mt-6 w-full">Get in touch</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
