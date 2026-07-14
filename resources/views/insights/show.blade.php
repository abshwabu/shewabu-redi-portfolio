@extends('layouts.app')

@section('title', $post->meta_title ?: ($post->title.' | Shewabu Redi Mohammed Authorized Accounting Firm'))
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(201,162,39,0.2),transparent_35%),linear-gradient(145deg,#0B2545,#15334E)]"></div>
        <div class="section-shell relative py-14 sm:py-18 lg:py-20">
            <a href="{{ route('insights.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary-100 transition hover:text-accent">
                <span aria-hidden="true">←</span> All insights
            </a>
            <div class="mt-6 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm font-semibold uppercase tracking-[0.12em] text-accent-200">
                @if ($post->category)
                    <span>{{ $post->category }}</span>
                @endif
                @if ($post->published_at)
                    <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('F j, Y') }}</time>
                @endif
            </div>
            <h1 class="mt-4 max-w-4xl font-display text-4xl font-bold sm:text-5xl">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="mt-5 max-w-3xl text-base leading-relaxed text-primary-100 sm:text-lg">{{ $post->excerpt }}</p>
            @endif
            @if ($post->author)
                <p class="mt-6 text-sm text-primary-100">
                    By
                    <a href="{{ route('team.show', $post->author) }}" class="font-semibold text-accent transition hover:text-accent-200">
                        {{ $post->author->name }}
                    </a>
                    @if ($post->author->role)
                        <span class="text-primary-200">· {{ $post->author->role }}</span>
                    @endif
                </p>
            @endif
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell max-w-4xl">
            @if ($post->featuredImageUrl())
                <img src="{{ $post->featuredImageUrl() }}" alt="" class="mb-10 h-64 w-full rounded-lg object-cover sm:h-80 lg:h-96">
            @endif
            <article class="surface-card">
                <div class="prose-firm text-surface-700">
                    {!! $post->body !!}
                </div>
            </article>
        </div>
    </section>

    @if ($relatedPosts->isNotEmpty())
        <section class="section-pad bg-white">
            <div class="section-shell">
                <p class="eyebrow">Continue reading</p>
                <h2 class="section-title">Related insights</h2>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedPosts as $related)
                        <article class="surface-card surface-card-hover flex h-full flex-col">
                            @if ($related->category)
                                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-accent">{{ $related->category }}</p>
                            @endif
                            <h3 class="mt-2 font-display text-lg font-bold text-primary">{{ $related->title }}</h3>
                            @if ($related->excerpt)
                                <p class="mt-2 flex-1 text-sm text-surface-600">{{ \Illuminate\Support\Str::limit($related->excerpt, 120) }}</p>
                            @endif
                            <a href="{{ route('insights.show', $related) }}" class="btn-ghost mt-5">
                                Read article
                                <span aria-hidden="true">→</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
