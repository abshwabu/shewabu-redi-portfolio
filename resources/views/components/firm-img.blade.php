@props([
    'src',
    'alt',
    'width' => null,
    'height' => null,
    'lazy' => true,
])

<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    @if ($lazy)
        loading="lazy"
        decoding="async"
    @else
        loading="eager"
        fetchpriority="high"
    @endif
    @if ($width && $height)
        width="{{ $width }}"
        height="{{ $height }}"
    @endif
    {{ $attributes }}
>
