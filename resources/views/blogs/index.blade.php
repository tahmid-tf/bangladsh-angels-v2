@extends('layouts.guest')
@section('page_title', 'Insights & Blog | Bangladesh Angels Network')

@push('head_meta')
    <x-seo-meta
        title="Insights & Blog | Bangladesh Angels Network"
        description="Ideas, educational resources, announcements, and perspectives from Bangladesh Angels Network."
        :canonical="route('blogs.index')"
        :image="asset('og.png')"
    />
@endpush

@section('page_content')
<main class="ban-blog-page">
    <header class="ban-blog-hero">
        <div class="ban-blog-shell">
            <p>Ideas from the ecosystem</p>
            <h1>Insights for investors and founders.</h1>
            <span>Perspectives, practical guidance, announcements, and stories shaping Bangladesh’s startup ecosystem.</span>
        </div>
    </header>

    <div class="ban-blog-shell ban-blog-layout">
        <section class="ban-blog-feed" aria-labelledby="blog-feed-heading">
            <div class="ban-blog-feed__heading">
                <div>
                    <p>Latest thinking</p>
                    <h2 id="blog-feed-heading">
                        @if($selectedCategory)
                            {{ $selectedCategory }}
                        @elseif($search)
                            Search results
                        @else
                            All articles
                        @endif
                    </h2>
                </div>
                @if($search || $selectedCategory)
                    <a href="{{ route('blogs.index') }}">Clear filters ×</a>
                @endif
            </div>

            @forelse($blogs as $blog)
                <article class="ban-blog-card">
                    <div class="ban-blog-card__meta">
                        <span>{{ $blog->category }}</span>
                        <time datetime="{{ $blog->displayDate()?->toDateString() }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"></rect><path d="M16 3v4M8 3v4M3 10h18"></path></svg>
                            {{ $blog->displayDate()?->format('d M, Y') }}
                        </time>
                        <span>{{ $blog->readingMinutes() }} min read</span>
                    </div>
                    <h3><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                    <p>{{ $blog->excerpt ?: \Illuminate\Support\Str::limit(trim(strip_tags($blog->content)), 220) }}</p>
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="ban-blog-read-more">Read article <span aria-hidden="true">→</span></a>
                </article>
            @empty
                <div class="ban-blog-empty">
                    <span>Nothing matched</span>
                    <h3>No articles found.</h3>
                    <p>Try a different search or browse all published articles.</p>
                    <a href="{{ route('blogs.index') }}">View all articles</a>
                </div>
            @endforelse

            @if($blogs->hasPages())
                <div class="ban-blog-pagination">{{ $blogs->links() }}</div>
            @endif
        </section>

        @include('blogs.partials.sidebar')
    </div>
</main>
@endsection
