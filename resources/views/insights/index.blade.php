@extends('layouts.app')

@section('title', 'Insights | '.$siteSettings->firm_name)
@section('meta_description', $siteSettings->seo_description)

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">Knowledge</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">Insights</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                Practical guidance on tax, audit, compliance, and financial management for Ethiopian businesses.
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($posts as $post)
                    <article class="surface-card surface-card-hover flex h-full flex-col overflow-hidden p-0">
                        <a href="{{ route('insights.show', $post) }}" class="group flex h-full flex-col">
                            @if ($post->featuredImageUrl())
                                <x-firm-img
                                    :src="$post->featuredImageUrl()"
                                    :alt="$post->title"
                                    width="640"
                                    height="176"
                                    class="h-44 w-full object-cover transition duration-300 group-hover:scale-[1.02] sm:h-48"
                                />
                            @else
                                <div class="flex h-44 items-center justify-center bg-primary-50 text-primary sm:h-48">
                                    <svg class="h-12 w-12 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.25" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col p-6">
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-semibold uppercase tracking-[0.12em] text-surface-500">
                                    @if ($post->category)
                                        <span class="text-accent">{{ $post->category }}</span>
                                    @endif
                                    @if ($post->published_at)
                                        <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('M j, Y') }}</time>
                                    @endif
                                </div>
                                <h2 class="mt-3 font-display text-xl font-bold text-primary transition group-hover:text-primary-700">{{ $post->title }}</h2>
                                @if ($post->excerpt)
                                    <p class="mt-3 flex-1 text-sm leading-relaxed text-surface-600">{{ $post->excerpt }}</p>
                                @endif
                                <span class="btn-ghost mt-5 self-start">
                                    Read article
                                    <span aria-hidden="true">→</span>
                                </span>
                            </div>
                        </a>
                    </article>
                @empty
                    <p class="text-surface-600 sm:col-span-2 lg:col-span-3">No published articles yet.</p>
                @endforelse
            </div>

            @if ($posts->hasPages())
                <nav class="mt-12 flex justify-center" aria-label="Insights pagination">
                    {{ $posts->links() }}
                </nav>
            @endif
        </div>
    </section>
@endsection
