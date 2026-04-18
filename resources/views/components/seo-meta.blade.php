@props([
    'title',
    'description',
    'canonical' => null,
    'image' => null,
    'siteName' => 'Bangladesh Angels Network Limited',
    'ogType' => 'website',
])

@php
    $canonical = $canonical ?? url()->current();
    $desc = \Illuminate\Support\Str::limit(trim(strip_tags((string) $description)), 160, '…');
    $img = $image ?? asset('icon.webp');
    $imgAbs = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : url($img);
@endphp

<link rel="canonical" href="{{ $canonical }}">
<meta name="description" content="{{ e($desc) }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="{{ e($ogType) }}">
<meta property="og:site_name" content="{{ e($siteName) }}">
<meta property="og:title" content="{{ e($title) }}">
<meta property="og:description" content="{{ e($desc) }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $imgAbs }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ e($title) }}">
<meta name="twitter:description" content="{{ e($desc) }}">
<meta name="twitter:image" content="{{ $imgAbs }}">
