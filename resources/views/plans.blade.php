@extends('layouts.guest')
@section('page_title', 'Subscription Plans | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Subscription Plans | Bangladesh Angels Network Limited"
        description="Compare Bangladesh Angels Network membership tiers — unlock deals, events, and investor tools with a plan that fits you."
        :canonical="route('plans')"
        :image="asset('icon.webp')"
    />
@endpush

@section('page_content')
<section class="container mx-auto px-4 py-12">
    @include('partials.subscription-plans', ['tiers' => $tiers])
</section>
@endsection
