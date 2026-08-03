@extends('layouts.guest')
@section('page_title', 'Angel Academy | Bangladesh Angels Network')

@push('head_meta')
    <x-seo-meta
        title="Angel Academy | Bangladesh Angels Network"
        description="A practical BAN learning program for aspiring and active angel investors. Build confidence in sourcing, evaluation, diligence, portfolio strategy, and investment decisions."
        :canonical="route('angel-academy')"
        :image="asset('og.png')"
    />
@endpush

@section('page_content')
<main class="ban-subpage ban-academy-page">
    <section class="ban-program-hero ban-program-hero--academy" aria-labelledby="academy-heading">
        <div class="ban-page-shell ban-program-hero__grid">
            <div>
                <a href="{{ route('home').'#programs' }}" class="ban-program-back"><span aria-hidden="true">←</span> Our programs</a>
                <p class="ban-page-kicker">Investor education by BAN</p>
                <h1 id="academy-heading">Build the judgment to invest with conviction.</h1>
                <p>Angel Academy turns early-stage investing from an opaque process into a practical, repeatable discipline—grounded in the realities of Bangladesh and the wider region.</p>
                <div class="ban-page-actions">
                    <a href="https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN" target="_blank" rel="noopener noreferrer" class="ban-page-button ban-page-button--primary">Book a Meeting <span aria-hidden="true">↗</span></a>
                    <a href="#academy-glossary" class="ban-page-button ban-page-button--ghost">Explore the glossary</a>
                </div>
            </div>
            <div class="ban-academy-mark" aria-hidden="true">
                <span>AA</span>
                <p>Learn · Evaluate · Invest</p>
            </div>
        </div>
    </section>

    <section class="ban-program-intro" aria-labelledby="academy-overview-heading">
        <div class="ban-page-shell ban-program-intro__grid">
            <header>
                <p class="ban-page-kicker">Program overview</p>
                <h2 id="academy-overview-heading">Designed for people ready to move from curiosity to capability.</h2>
            </header>
            <div>
                <p>Angel Academy is for aspiring angels, active investors, founders who want to understand the other side of the table, and professionals exploring venture capital. Sessions combine core concepts, local casework, analyst guidance, and investment-committee practice.</p>
                <dl class="ban-program-facts">
                    <div><dt>Format</dt><dd>Practical cohort</dd></div>
                    <div><dt>Curriculum</dt><dd>15 guided sessions</dd></div>
                    <div><dt>Method</dt><dd>Cases + live practice</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <section class="ban-academy-path" aria-labelledby="academy-path-heading">
        <div class="ban-page-shell">
            <header class="ban-page-heading">
                <p class="ban-page-kicker">What you will learn</p>
                <h2 id="academy-path-heading">A clear path through the investment journey.</h2>
            </header>
            <div class="ban-academy-path__grid">
                <article>
                    <span>01</span>
                    <h3>Foundations</h3>
                    <p>Understand venture returns, portfolio construction, funding stages, cap tables, and the role of an angel investor.</p>
                    <a href="#glossary-cap-table">Start with cap tables <span aria-hidden="true">↓</span></a>
                </article>
                <article>
                    <span>02</span>
                    <h3>Evaluation</h3>
                    <p>Assess founders, markets, products, business models, traction, unit economics, risk, and investment fit.</p>
                    <a href="#glossary-unit-economics">Understand unit economics <span aria-hidden="true">↓</span></a>
                </article>
                <article>
                    <span>03</span>
                    <h3>Execution</h3>
                    <p>Practice diligence, valuation, term-sheet review, investment committee decisions, and post-investment support.</p>
                    <a href="#glossary-term-sheet">Review term sheets <span aria-hidden="true">↓</span></a>
                </article>
            </div>
        </div>
    </section>

    <section id="academy-glossary" class="ban-academy-glossary" aria-labelledby="academy-glossary-heading">
        <div class="ban-page-shell">
            <header class="ban-page-heading ban-page-heading--split">
                <div>
                    <p class="ban-page-kicker">Clickable glossary</p>
                    <h2 id="academy-glossary-heading">The language of angel investing, made useful.</h2>
                </div>
                <nav aria-label="Angel investing glossary terms">
                    <a href="#glossary-cap-table">Cap table</a>
                    <a href="#glossary-dilution">Dilution</a>
                    <a href="#glossary-unit-economics">Unit economics</a>
                    <a href="#glossary-term-sheet">Term sheet</a>
                    <a href="#glossary-liquidation-preference">Liquidation preference</a>
                    <a href="#glossary-spv">SPV</a>
                </nav>
            </header>

            <div class="ban-glossary-list">
                <article id="glossary-cap-table"><span>01</span><div><h3>Cap table</h3><p>A record of who owns the company, how much they own, and the securities or options that may change ownership over time.</p></div></article>
                <article id="glossary-dilution"><span>02</span><div><h3>Dilution</h3><p>The reduction in an existing shareholder’s percentage ownership when the company issues new shares or options.</p></div></article>
                <article id="glossary-unit-economics"><span>03</span><div><h3>Unit economics</h3><p>The revenue and direct cost associated with one customer or transaction, used to test whether growth can become sustainable.</p></div></article>
                <article id="glossary-term-sheet"><span>04</span><div><h3>Term sheet</h3><p>A summary of the principal commercial and governance terms proposed for an investment before definitive agreements are signed.</p></div></article>
                <article id="glossary-liquidation-preference"><span>05</span><div><h3>Liquidation preference</h3><p>A right that determines how proceeds are distributed to preferred shareholders before common shareholders in certain exit or liquidation events.</p></div></article>
                <article id="glossary-spv"><span>06</span><div><h3>Special-purpose vehicle (SPV)</h3><p>A separate legal entity created for a defined purpose, often to pool several investors into a single investment.</p></div></article>
            </div>
        </div>
    </section>

    <section class="ban-program-cta" aria-labelledby="academy-cta-heading">
        <div class="ban-page-shell">
            <p>Ready to take the next step?</p>
            <h2 id="academy-cta-heading">Talk to BAN about Angel Academy.</h2>
            <a href="https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN" target="_blank" rel="noopener noreferrer">Book a Meeting <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
@endsection
