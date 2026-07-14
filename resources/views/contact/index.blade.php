@extends('layouts.app')

@section('title', 'Contact | Shewabu Redi Mohammed Authorized Accounting Firm')
@section('meta_description', 'Contact Shewabu Redi Mohammed Authorized Accounting Firm for audit, tax, and advisory services in Addis Ababa.')

@section('content')
    <section class="relative overflow-hidden bg-primary text-surface-50">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,#0B2545_0%,#1E4568_55%,#0B2545_100%)]"></div>
        <div class="section-shell relative py-16 sm:py-20">
            <p class="eyebrow text-accent-200">Get in touch</p>
            <h1 class="mt-4 font-display text-4xl font-bold sm:text-5xl">Contact Us</h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-primary-100 sm:text-lg">
                Share your requirements and we will respond with next steps for your audit, tax, or advisory engagement.
            </p>
        </div>
    </section>

    <section class="section-pad bg-surface-50">
        <div class="section-shell grid gap-10 lg:grid-cols-2 lg:gap-12">
            {{-- Contact form --}}
            <div
                class="surface-card"
                x-data="{
                    submitting: false,
                    success: false,
                    error: '',
                    errors: {},
                    form: {
                        name: '',
                        email: '',
                        phone: '',
                        subject: '',
                        message: '',
                    },
                    async submit() {
                        this.submitting = true;
                        this.error = '';
                        this.errors = {};

                        try {
                            const response = await fetch('{{ route('contact.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                },
                                body: JSON.stringify(this.form),
                            });

                            const data = await response.json().catch(() => ({}));

                            if (response.status === 422) {
                                this.errors = data.errors ?? {};
                                return;
                            }

                            if (! response.ok) {
                                this.error = 'Something went wrong. Please try again.';
                                return;
                            }

                            this.success = true;
                            this.form = { name: '', email: '', phone: '', subject: '', message: '' };
                        } catch (e) {
                            this.error = 'Unable to send your message. Please check your connection and try again.';
                        } finally {
                            this.submitting = false;
                        }
                    },
                }"
            >
                <h2 class="font-display text-2xl font-bold text-primary">Send a message</h2>
                <p class="mt-2 text-sm text-surface-600">All fields marked with * are required.</p>

                <div
                    x-show="success"
                    x-cloak
                    class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-4 text-sm text-green-800"
                    role="status"
                >
                    <p class="font-semibold">Message sent successfully.</p>
                    <p class="mt-1">Thank you for contacting us. We will respond shortly.</p>
                </div>

                <div
                    x-show="error"
                    x-cloak
                    class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-800"
                    role="alert"
                    x-text="error"
                ></div>

                <form class="mt-6 space-y-5" @submit.prevent="submit" x-show="! success" novalidate>
                    <div>
                        <label for="contact-name" class="block text-sm font-semibold text-primary">Name *</label>
                        <input
                            id="contact-name"
                            type="text"
                            x-model="form.name"
                            autocomplete="name"
                            required
                            class="mt-2 block w-full min-h-12 rounded-lg border border-surface-300 bg-white px-4 py-3 text-base text-surface-800 shadow-sm transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30"
                            :class="errors.name ? 'border-red-400' : ''"
                            :aria-invalid="errors.name ? 'true' : 'false'"
                            :aria-describedby="errors.name ? 'contact-name-error' : null"
                        >
                        <p x-show="errors.name" x-cloak id="contact-name-error" class="mt-1.5 text-sm text-red-600" x-text="errors.name?.[0]"></p>
                    </div>

                    <div>
                        <label for="contact-email" class="block text-sm font-semibold text-primary">Email *</label>
                        <input
                            id="contact-email"
                            type="email"
                            x-model="form.email"
                            autocomplete="email"
                            inputmode="email"
                            required
                            class="mt-2 block w-full min-h-12 rounded-lg border border-surface-300 bg-white px-4 py-3 text-base text-surface-800 shadow-sm transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30"
                            :class="errors.email ? 'border-red-400' : ''"
                            :aria-invalid="errors.email ? 'true' : 'false'"
                            :aria-describedby="errors.email ? 'contact-email-error' : null"
                        >
                        <p x-show="errors.email" x-cloak id="contact-email-error" class="mt-1.5 text-sm text-red-600" x-text="errors.email?.[0]"></p>
                    </div>

                    <div>
                        <label for="contact-phone" class="block text-sm font-semibold text-primary">Phone</label>
                        <input
                            id="contact-phone"
                            type="tel"
                            x-model="form.phone"
                            autocomplete="tel"
                            inputmode="tel"
                            class="mt-2 block w-full min-h-12 rounded-lg border border-surface-300 bg-white px-4 py-3 text-base text-surface-800 shadow-sm transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30"
                            :class="errors.phone ? 'border-red-400' : ''"
                        >
                        <p x-show="errors.phone" x-cloak class="mt-1.5 text-sm text-red-600" x-text="errors.phone?.[0]"></p>
                    </div>

                    <div>
                        <label for="contact-subject" class="block text-sm font-semibold text-primary">Subject</label>
                        <input
                            id="contact-subject"
                            type="text"
                            x-model="form.subject"
                            class="mt-2 block w-full min-h-12 rounded-lg border border-surface-300 bg-white px-4 py-3 text-base text-surface-800 shadow-sm transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30"
                            :class="errors.subject ? 'border-red-400' : ''"
                        >
                        <p x-show="errors.subject" x-cloak class="mt-1.5 text-sm text-red-600" x-text="errors.subject?.[0]"></p>
                    </div>

                    <div>
                        <label for="contact-message" class="block text-sm font-semibold text-primary">Message *</label>
                        <textarea
                            id="contact-message"
                            rows="5"
                            x-model="form.message"
                            required
                            class="mt-2 block w-full min-h-32 rounded-lg border border-surface-300 bg-white px-4 py-3 text-base text-surface-800 shadow-sm transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30"
                            :class="errors.message ? 'border-red-400' : ''"
                            :aria-invalid="errors.message ? 'true' : 'false'"
                            :aria-describedby="errors.message ? 'contact-message-error' : null"
                        ></textarea>
                        <p x-show="errors.message" x-cloak id="contact-message-error" class="mt-1.5 text-sm text-red-600" x-text="errors.message?.[0]"></p>
                    </div>

                    <button
                        type="submit"
                        class="btn-primary w-full min-h-12 disabled:cursor-not-allowed disabled:opacity-60"
                        :disabled="submitting"
                    >
                        <span x-show="! submitting">Send message</span>
                        <span x-show="submitting" x-cloak>Sending…</span>
                    </button>
                </form>
            </div>

            {{-- Office info + map --}}
            <div class="space-y-6">
                <div class="surface-card">
                    <h2 class="font-display text-2xl font-bold text-primary">Office</h2>
                    <ul class="mt-5 space-y-4 text-sm text-surface-700">
                        @php
                            $addressLine = collect([$settings->address, $settings->city, $settings->country])->filter()->implode(', ');
                        @endphp
                        @if ($addressLine)
                            <li class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>{{ $addressLine }}</span>
                            </li>
                        @endif
                        @if ($settings->phone)
                            <li class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone) }}" class="min-h-11 inline-flex items-center font-semibold text-primary transition hover:text-accent">{{ $settings->phone }}</a>
                            </li>
                        @endif
                        @if ($settings->email)
                            <li class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <a href="mailto:{{ $settings->email }}" class="min-h-11 inline-flex items-center font-semibold text-primary transition hover:text-accent">{{ $settings->email }}</a>
                            </li>
                        @endif
                        @if ($settings->office_hours)
                            <li class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $settings->office_hours }}</span>
                            </li>
                        @endif
                    </ul>
                </div>

                @if ($settings->google_maps_embed)
                    <div class="surface-card overflow-hidden p-0">
                        <div class="aspect-[4/3] w-full sm:aspect-video">
                            <iframe
                                src="{{ $settings->google_maps_embed }}"
                                title="Office location map"
                                class="h-full w-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
