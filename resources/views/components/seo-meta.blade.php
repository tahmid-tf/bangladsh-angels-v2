@props([
    'title',
    'description',
    'canonical' => null,
    'image' => null,
    'imageAlt' => null,
    'siteName' => 'Bangladesh Angels Network Limited',
    'ogType' => 'website',
    'locale' => 'en_GB',
    'keywords' => null,
    'author' => 'Bangladesh Angels Network',
    'jsonLd' => null,
])

@php
    $canonical = $canonical ?? url()->current();
    $desc = \Illuminate\Support\Str::limit(trim(strip_tags((string) $description)), 160, '…');
    $img = $image ?? asset('icon.webp');
    $imgAbs = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : url($img);
    $imageAlt = $imageAlt ?? $siteName;
@endphp

<link rel="canonical" href="{{ $canonical }}">
<meta name="description" content="{{ e($desc) }}">
<meta name="author" content="{{ e($author) }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
@if (filled($keywords))
    <meta name="keywords" content="{{ e($keywords) }}">
@endif
<link rel="alternate" hreflang="x-default" href="{{ $canonical }}">
<link rel="alternate" hreflang="en" href="{{ $canonical }}">
<meta property="og:type" content="{{ e($ogType) }}">
<meta property="og:locale" content="{{ e($locale) }}">
<meta property="og:site_name" content="{{ e($siteName) }}">
<meta property="og:title" content="{{ e($title) }}">
<meta property="og:description" content="{{ e($desc) }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $imgAbs }}">
<meta property="og:image:alt" content="{{ e($imageAlt) }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ e($title) }}">
<meta name="twitter:description" content="{{ e($desc) }}">
<meta name="twitter:image" content="{{ $imgAbs }}">
@if (is_array($jsonLd))
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) !!}</script>
@endif
