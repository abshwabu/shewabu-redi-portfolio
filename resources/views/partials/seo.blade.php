@php
    $defaults = $siteSettings ?? \App\Models\SiteSetting::current();
    $pageTitle = trim($__env->yieldContent('title'));
    $seoTitle = trim($__env->yieldContent('seo_title')) ?: $pageTitle ?: ($defaults->seo_title ?: $defaults->firm_name);
    $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($defaults->seo_description ?? '');
    $metaKeywords = trim($__env->yieldContent('meta_keywords')) ?: ($defaults->seo_keywords ?? '');
    $ogTitle = trim($__env->yieldContent('og_title')) ?: $seoTitle;
    $ogDescription = trim($__env->yieldContent('og_description')) ?: $metaDescription;
    $ogImage = trim($__env->yieldContent('og_image')) ?: ($defaults->ogImageUrl() ?? '');
    if (filled($ogImage) && ! str_starts_with($ogImage, 'http')) {
        $ogImage = url($ogImage);
    }
    $ogType = trim($__env->yieldContent('og_type')) ?: 'website';
    $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();
    $robots = trim($__env->yieldContent('robots')) ?: 'index,follow';
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
@if (filled($metaKeywords))
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ $robots }}">

<meta property="og:site_name" content="{{ $defaults->firm_name }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
@if (filled($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
@endif

<meta name="twitter:card" content="{{ filled($ogImage) ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
@if (filled($ogImage))
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif
