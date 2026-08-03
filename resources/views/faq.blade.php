@extends('layouts.guest')
@section('page_title', 'FAQ | Bangladesh Angels Network')

@push('head_meta')
    <x-seo-meta
        title="FAQ | Bangladesh Angels Network"
        description="Answers to 20 frequently asked questions about BAN, angel-investing returns, regulations, exits, SPVs, taxes, diligence, documentation, and portfolio support."
        :canonical="route('faq')"
        :image="asset('og.png')"
    />
@endpush

@section('page_content')
<main class="ban-subpage ban-faq-page">
    <section class="ban-faq-hero" aria-labelledby="faq-page-heading">
        <div class="ban-page-shell">
            <p class="ban-page-kicker">BAN knowledge base</p>
            <h1 id="faq-page-heading">Frequently Asked Questions about BAN</h1>
            <p>Clear answers about returns, regulation, exits, investor protection, foreign investment, SPVs, documentation, diligence, and portfolio support.</p>

            <div class="ban-faq-search">
                <label for="faq-search">Search the FAQ</label>
                <div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-3.5-3.5"></path></svg>
                    <input id="faq-search" type="search" placeholder="Try &quot;SPV&quot;, &quot;tax&quot;, or &quot;exits&quot;" autocomplete="off">
                </div>
            </div>
        </div>
    </section>

    <section class="ban-faq-content" aria-labelledby="faq-list-heading">
        <div class="ban-page-shell ban-faq-content__layout">
            <aside>
                <p class="ban-page-kicker">BAN knowledge base</p>
                <h2 id="faq-list-heading">{{ count($faqs) }} essential answers</h2>
                <p>Adapted from BAN's supplied FAQ document. This general information does not replace independent legal, tax, banking, or investment advice.</p>
            </aside>

            <div>
                <p id="faq-no-results" class="ban-faq-no-results" hidden>No matching questions found. Try a broader search or contact our team.</p>
                <div id="faq-list" class="ban-page-faq-list">
                    @foreach ($faqs as $faq)
                        <details class="ban-page-faq-item" data-faq-item>
                            <summary>
                                <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <strong>{{ $faq['question'] }}</strong>
                                <i aria-hidden="true"></i>
                            </summary>
                            <div class="ban-page-faq-item__answer">
                                @foreach ($faq['paragraphs'] as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                                @isset($faq['bullets'])
                                    <ul>
                                        @foreach ($faq['bullets'] as $bullet)<li>{{ $bullet }}</li>@endforeach
                                    </ul>
                                @endisset
                                @isset($faq['note'])
                                    <p class="ban-page-faq-item__note">{{ $faq['note'] }}</p>
                                @endisset
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="ban-page-contact" aria-labelledby="faq-contact-heading">
        <div class="ban-page-shell">
            <p>Still have a question?</p>
            <h2 id="faq-contact-heading">Can’t find what you’re looking for?</h2>
            <a href="mailto:hello@bdangels.co">Contact us <span aria-hidden="true">→</span></a>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('faq-search');
        const items = Array.from(document.querySelectorAll('[data-faq-item]'));
        const empty = document.getElementById('faq-no-results');
        if (!search || !empty) return;

        search.addEventListener('input', function () {
            const query = search.value.trim().toLocaleLowerCase();
            let visible = 0;
            items.forEach(function (item) {
                const matches = !query || item.textContent.toLocaleLowerCase().includes(query);
                item.hidden = !matches;
                if (matches) visible += 1;
            });
            empty.hidden = visible !== 0;
        });
    });
</script>
@endsection
