@extends('layouts.guest')
@section('page_title', 'BWIN | Bangladesh Women Investors Network')

@push('head_meta')
    <x-seo-meta
        title="BWIN | Bangladesh Women Investors Network"
        description="Bangladesh Women Investors Network is a women-led angel-investing community growing the pipeline of women investors and entrepreneurs."
        :canonical="route('bwin')"
        :image="asset('og.png')"
    />
@endpush

@section('page_content')
<main class="ban-subpage ban-bwin-page">
    <section class="ban-program-hero ban-program-hero--bwin" aria-labelledby="bwin-heading">
        <div class="ban-page-shell ban-program-hero__grid">
            <div>
                <a href="{{ route('home').'#programs' }}" class="ban-program-back"><span aria-hidden="true">←</span> Our programs</a>
                <img src="{{ asset('bwin.png') }}" class="ban-bwin-logo" alt="BWIN — Bangladesh Women Investors Network" width="570" height="181">
                <h1 id="bwin-heading">More women shaping where capital goes.</h1>
                <p>BWIN is Bangladesh's first women-led angel-investing network and a sister chapter of BAN, built to grow a confident community of women investors while backing high-potential early-stage founders.</p>
                <div class="ban-page-actions">
                    <a href="mailto:hello@bdangels.co?subject=BWIN%20membership%20enquiry" class="ban-page-button ban-page-button--bwin">Join the BWIN community <span aria-hidden="true">→</span></a>
                    <a href="#bwin-model" class="ban-page-button ban-page-button--ghost-light">How BWIN works</a>
                </div>
            </div>
            <div class="ban-bwin-photo">
                <img src="{{ asset('bwin2.png') }}" alt="Members and guests at a Bangladesh Women Investors Network event" width="330" height="379" loading="eager">
            </div>
        </div>
    </section>

    <section class="ban-program-intro" aria-labelledby="bwin-mission-heading">
        <div class="ban-page-shell ban-program-intro__grid">
            <header>
                <p class="ban-page-kicker ban-page-kicker--bwin">Our mission</p>
                <h2 id="bwin-mission-heading">A more representative investment ecosystem starts with who gets a seat at the table.</h2>
            </header>
            <div>
                <p>BWIN makes angel investing more visible, accessible, and collaborative for women. Through education, curated startup access, peer learning, and practical participation, members can build confidence at their own pace.</p>
                <p>The network applies a gender lens while remaining focused on commercially strong pre-seed and seed-stage opportunities with the capacity to create durable value.</p>
            </div>
        </div>
    </section>

    <section id="bwin-model" class="ban-bwin-model" aria-labelledby="bwin-model-heading">
        <div class="ban-page-shell">
            <header class="ban-page-heading">
                <p class="ban-page-kicker ban-page-kicker--bwin">How BWIN works</p>
                <h2 id="bwin-model-heading">Learn together. Evaluate together. Invest independently.</h2>
            </header>
            <div class="ban-bwin-model__grid">
                <article><span>01</span><h3>Learn</h3><p>Build fluency in startup finance, diligence, valuation, risk, and portfolio thinking through practical sessions.</p></article>
                <article><span>02</span><h3>Connect</h3><p>Meet experienced investors, operators, founders, and peers in a trusted women-led community.</p></article>
                <article><span>03</span><h3>Discover</h3><p>Access curated early-stage companies and understand the opportunity through shared evaluation.</p></article>
                <article><span>04</span><h3>Participate</h3><p>Choose how to engage—from observing and mentoring to joining diligence or making an investment.</p></article>
            </div>
        </div>
    </section>

    <section class="ban-bwin-audience" aria-labelledby="bwin-audience-heading">
        <div class="ban-page-shell ban-bwin-audience__grid">
            <div>
                <p class="ban-page-kicker ban-page-kicker--bwin">Who it is for</p>
                <h2 id="bwin-audience-heading">You do not need to arrive as an expert.</h2>
            </div>
            <ul>
                <li><strong>Aspiring investors</strong><span>Learn the fundamentals before writing a first cheque.</span></li>
                <li><strong>Experienced professionals</strong><span>Put industry knowledge and operating experience to work.</span></li>
                <li><strong>Active angels</strong><span>Expand deal flow, perspective, and peer collaboration.</span></li>
                <li><strong>Women founders</strong><span>Connect with investors who understand the value of diverse leadership.</span></li>
            </ul>
        </div>
    </section>

    <section class="ban-program-cta ban-program-cta--bwin" aria-labelledby="bwin-cta-heading">
        <div class="ban-page-shell">
            <p>Be part of what comes next.</p>
            <h2 id="bwin-cta-heading">Join Bangladesh's women investor community.</h2>
            <a href="mailto:hello@bdangels.co?subject=BWIN%20membership%20enquiry">Contact BWIN <span aria-hidden="true">→</span></a>
        </div>
    </section>
</main>
@endsection
