@props([
    'locale' => app()->getLocale(),
])

@php
    $isAmharic = $locale === 'am';
@endphp

<div
    class="lang-toggle"
    role="group"
    aria-label="{{ __('site.language') }}"
    x-data="{
        locale: @js($locale),
        switching: false,
        async toggle() {
            if (this.switching) return;
            this.switching = true;
            try {
                const response = await fetch('{{ route('locale.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    },
                });
                if (response.ok) {
                    window.location.reload();
                }
            } finally {
                this.switching = false;
            }
        },
    }"
>
    <button
        type="button"
        class="lang-toggle__track"
        :class="locale === 'am' ? 'lang-toggle__track--am' : 'lang-toggle__track--en'"
        :aria-pressed="(locale === 'am').toString()"
        :aria-label="locale === 'am' ? '{{ __('site.language_am') }}' : '{{ __('site.language_en') }}'"
        @click="toggle()"
        :disabled="switching"
    >
        <span class="lang-toggle__thumb" aria-hidden="true"></span>
        <span class="lang-toggle__label lang-toggle__label--en" :class="locale === 'en' ? 'lang-toggle__label--active' : ''">EN</span>
        <span class="lang-toggle__label lang-toggle__label--am" :class="locale === 'am' ? 'lang-toggle__label--active' : ''">አማ</span>
    </button>
</div>
