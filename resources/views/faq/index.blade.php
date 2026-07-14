@extends('layouts.app')

@section('title', 'FAQ | Shewabu Redi Mohammed Authorized Accounting Firm')
@section('meta_description', 'Frequently asked questions about audit, tax, and advisory services at Shewabu Redi Mohammed Authorized Accounting Firm.')

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">Support</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">Frequently Asked Questions</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                Answers to common questions about our services, engagements, and how we work with clients.
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50" x-data="{ open: null }">
        <div class="section-shell max-w-3xl space-y-10">
            @forelse ($groupedFaqs as $category => $faqs)
                <div>
                    @if ($groupedFaqs->count() > 1)
                        <h2 class="font-display text-2xl font-bold text-primary">{{ $category }}</h2>
                    @endif
                    <div @class(['space-y-3', 'mt-6' => $groupedFaqs->count() > 1]) role="region" aria-label="{{ $category }} questions">
                        @foreach ($faqs as $faq)
                            <div class="surface-card overflow-hidden p-0">
                                <h3>
                                    <button
                                        type="button"
                                        id="faq-trigger-{{ $faq->id }}"
                                        class="flex w-full min-h-14 items-center justify-between gap-4 px-5 py-4 text-left text-base font-semibold text-primary transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-accent sm:px-6 sm:text-lg"
                                        :aria-expanded="(open === {{ $faq->id }}).toString()"
                                        aria-controls="faq-panel-{{ $faq->id }}"
                                        @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}"
                                        @keydown.enter.prevent="open = open === {{ $faq->id }} ? null : {{ $faq->id }}"
                                        @keydown.space.prevent="open = open === {{ $faq->id }} ? null : {{ $faq->id }}"
                                    >
                                        <span>{{ $faq->question }}</span>
                                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-50 text-primary" aria-hidden="true">
                                            <svg class="h-4 w-4 transition-transform duration-200" :class="open === {{ $faq->id }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div
                                    id="faq-panel-{{ $faq->id }}"
                                    role="region"
                                    aria-labelledby="faq-trigger-{{ $faq->id }}"
                                    x-show="open === {{ $faq->id }}"
                                    x-cloak
                                    class="border-t border-surface-200"
                                >
                                    <div class="prose-firm px-5 py-4 text-sm text-surface-700 sm:px-6 sm:text-base">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-surface-600">No FAQs published yet.</p>
            @endforelse

            <div class="surface-card border-accent/25 bg-primary text-center text-surface-50">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent">Still have questions?</p>
                <p class="mt-3 text-sm leading-relaxed text-primary-100">Our team is happy to discuss your specific situation.</p>
                <a href="{{ route('contact') }}" class="btn-primary mt-6 inline-flex">Contact us</a>
            </div>
        </div>
    </section>
@endsection
