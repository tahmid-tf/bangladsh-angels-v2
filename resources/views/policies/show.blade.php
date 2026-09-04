@extends('layouts.guest')
@section('page_title', $page['title'].' | Bangladesh Angels')
@section('page_content')
<main class="ban-policy-shell">
    <header class="ban-policy-header">
        <p class="ban-page-kicker">Bangladesh Angels Network Limited</p>
        <h1>{{ $page['title'] }}</h1>
        @if($policy !== 'about-us')<p>Website and annual membership policies.</p>@endif
    </header>
    <div class="ban-policy-layout">
        <nav class="ban-policy-nav" aria-label="Company information and policies">
            @foreach($pages as $slug => $item)
                <a href="{{ $slug === 'about-us' ? route('about-us') : route('policies.show', $slug) }}" @if($slug === $policy) aria-current="page" @endif>{{ $item['title'] }}</a>
            @endforeach
            <a href="{{ route('services') }}">Services &amp; membership</a>
            <a href="{{ route('contact') }}">Contact &amp; business details</a>
        </nav>
        <article class="ban-policy-prose">
            @include('policies.blocks', ['blocks' => $page['blocks']])
            @if($policy === 'about-us')
                @include('policies.business-details')
            @endif
        </article>
    </div>
</main>
@endsection
