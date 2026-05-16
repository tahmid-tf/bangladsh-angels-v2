@extends('layouts.guest')
@section('page_title', 'Apply to the Network | BAN Angel Academy')

@php
    $applyCanonical = route('angel-academy.apply', [], true);
    $m = \App\Models\AngelAcademyNetworkApplication::class;
@endphp

@push('head_meta')
    <x-seo-meta
        title="Apply to the Network | BAN Angel Academy | Bangladesh Angels Network"
        description="Apply to join the Bangladesh Angels Network fellowship. Share your investing experience, motivation, and sector interests."
        :canonical="$applyCanonical"
        keywords="Bangladesh Angels Network, angel investor application, BAN fellowship, angel academy"
        :image="asset('investor_cover.webp')"
        imageAlt="Apply to Bangladesh Angels Network"
    />
@endpush

@push('head_styles')
<style>
    .angel-academy .aa-hero-blob { animation: aa-float 22s ease-in-out infinite; }
    .angel-academy .aa-hero-blob--2 { animation: aa-float 28s ease-in-out infinite reverse; animation-delay: -4s; }
    @keyframes aa-float {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.2; }
        50% { transform: translate(3%, -2%) scale(1.05); opacity: 0.28; }
    }
    @media (prefers-reduced-motion: reduce) {
        .angel-academy .aa-hero-blob,
        .angel-academy .aa-hero-blob--2 { animation: none !important; opacity: 0.2 !important; }
    }
    .aa-apply-fieldset legend { font-size: 0.875rem; font-weight: 600; color: #0f3d34; margin-bottom: 0.5rem; }
    .aa-apply-check {
        display: flex; align-items: flex-start; gap: 0.5rem;
        padding: 0.45rem 0.65rem; border-radius: 0.5rem;
        border: 1px solid #c5e6d8; background: #fdfefe;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .aa-apply-check:has(input:focus-visible) { outline: 2px solid #36b37e; outline-offset: 2px; }
    .aa-apply-check:has(input:checked) { border-color: #36b37e; background: #f0fdf7; box-shadow: inset 3px 0 0 0 #36b37e; }
    .aa-apply-check input { margin-top: 0.2rem; accent-color: #0a5c50; }
</style>
@endpush

@section('page_content')
<div class="angel-academy w-full min-w-0 overflow-x-clip text-[#0f3d34]">
    <section
        class="relative overflow-hidden border-b border-emerald-900/20 bg-gradient-to-br from-[#021a16] via-[#06352e] to-[#0a4a42]"
        aria-labelledby="aa-apply-hero-heading"
    >
        <div
            class="pointer-events-none absolute inset-0 opacity-[0.12]"
            style="background-image: linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px), linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 48px 48px;"
            aria-hidden="true"
        ></div>
        <div class="aa-hero-blob pointer-events-none absolute -right-24 top-0 h-96 w-96 rounded-full bg-[#36b37e]/20 blur-3xl" aria-hidden="true"></div>
        <div class="aa-hero-blob aa-hero-blob--2 pointer-events-none absolute -left-20 bottom-0 h-64 w-64 rounded-full bg-amber-400/10 blur-3xl" aria-hidden="true"></div>

        <div class="relative mx-auto max-w-5xl px-4 py-10 sm:px-6 sm:py-14 md:py-16">
            <p class="text-center text-xs font-semibold uppercase tracking-[0.25em] text-emerald-200/90">BAN Angel Academy</p>
            <h1 id="aa-apply-hero-heading" class="mt-4 text-center text-2xl font-extrabold tracking-tight text-white sm:text-3xl md:text-4xl">
                <span class="bg-gradient-to-r from-white via-[#d1fae5] to-white/90 bg-clip-text text-transparent">Apply to the Network</span>
            </h1>
            <p class="mx-auto mt-3 max-w-2xl text-center text-sm leading-relaxed text-emerald-100/95 sm:text-base">
                Tell us about your investing journey and what you hope to get from the fellowship. We review every application.
            </p>
            <div class="mt-6 flex justify-center">
                <a
                    href="{{ route('angel-academy') }}"
                    class="inline-flex items-center text-sm font-semibold text-emerald-100 underline-offset-4 hover:text-white hover:underline"
                >
                    ← Back to Angel Academy
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6 md:py-14" aria-labelledby="aa-apply-form-heading">
        <h2 id="aa-apply-form-heading" class="sr-only">Application form</h2>

        @if (session('angel_academy_apply_success'))
            <div class="mb-8 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-emerald-900 shadow-sm" role="status">
                <p class="font-semibold">Thank you — your application was received.</p>
                <p class="mt-1 text-sm text-emerald-800/90">Our team will be in touch using the contact details you provided.</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-red-900" role="alert">
                <p class="font-semibold">Please fix the following:</p>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="post"
            action="{{ route('angel-academy.apply.store') }}"
            class="overflow-hidden rounded-2xl border border-[#c5e6d8]/80 bg-gradient-to-b from-white to-[#f7fdfb] shadow-[0_8px_40px_-12px_rgba(15,61,52,0.12)]"
        >
            @csrf

            <div class="border-b border-[#e2f0ea] bg-[#eef8f4]/80 px-4 py-3 sm:px-6">
                <p class="text-xs font-bold uppercase tracking-wider text-[#0f3d34]">Fellowship application</p>
            </div>

            <div class="space-y-8 px-4 py-6 sm:px-6 sm:py-8">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-800">Your Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            maxlength="255"
                            value="{{ old('name', auth()->user()?->name) }}"
                            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm focus:border-[#0a5c50] focus:ring-2 focus:ring-[#36b37e]/40"
                        />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-800">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            maxlength="255"
                            value="{{ old('email', auth()->user()?->email) }}"
                            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm focus:border-[#0a5c50] focus:ring-2 focus:ring-[#36b37e]/40"
                        />
                    </div>
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-800">Contact Number (WhatsApp)</label>
                        <input
                            type="text"
                            id="contact_number"
                            name="contact_number"
                            required
                            maxlength="64"
                            value="{{ old('contact_number', auth()->user()?->phone) }}"
                            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm focus:border-[#0a5c50] focus:ring-2 focus:ring-[#36b37e]/40"
                        />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="linkedin_url" class="block text-sm font-medium text-gray-800">LinkedIn Profile</label>
                        <input
                            type="text"
                            id="linkedin_url"
                            name="linkedin_url"
                            required
                            maxlength="512"
                            placeholder="https://linkedin.com/in/…"
                            value="{{ old('linkedin_url') }}"
                            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm focus:border-[#0a5c50] focus:ring-2 focus:ring-[#36b37e]/40"
                        />
                    </div>
                </div>

                <fieldset class="aa-apply-fieldset space-y-2 rounded-xl border border-[#e2f0ea] bg-white/60 p-4 sm:p-5">
                    <legend>Have you invested in startups before?</legend>
                    <div class="space-y-2">
                        @foreach ($m::INVESTED_BEFORE as $value => $label)
                            <label class="aa-apply-check cursor-pointer">
                                <input
                                    type="radio"
                                    name="invested_before"
                                    value="{{ $value }}"
                                    class="shrink-0"
                                    {{ old('invested_before') === $value ? 'checked' : '' }}
                                    @if ($loop->first) required @endif
                                />
                                <span class="text-sm text-gray-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="aa-apply-fieldset space-y-2 rounded-xl border border-[#e2f0ea] bg-white/60 p-4 sm:p-5">
                    <legend>What is your primary motivation for joining the fellowship?</legend>
                    <div class="space-y-2">
                        @foreach ($m::PRIMARY_MOTIVATION as $value => $label)
                            <label class="aa-apply-check cursor-pointer">
                                <input
                                    type="radio"
                                    name="primary_motivation"
                                    value="{{ $value }}"
                                    class="shrink-0"
                                    {{ old('primary_motivation') === $value ? 'checked' : '' }}
                                    @if ($loop->first) required @endif
                                />
                                <span class="text-sm text-gray-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="aa-apply-fieldset space-y-2 rounded-xl border border-[#e2f0ea] bg-white/60 p-4 sm:p-5">
                    <legend>Which startup stages interest you most? <span class="font-normal text-gray-500">(select all that apply)</span></legend>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ($m::STARTUP_STAGES as $value => $label)
                            <label class="aa-apply-check cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="startup_stages[]"
                                    value="{{ $value }}"
                                    class="shrink-0"
                                    {{ in_array($value, old('startup_stages', []), true) ? 'checked' : '' }}
                                />
                                <span class="text-sm text-gray-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="aa-apply-fieldset space-y-2 rounded-xl border border-[#e2f0ea] bg-white/60 p-4 sm:p-5">
                    <legend>Which sectors are you most interested in? <span class="font-normal text-gray-500">(select all that apply)</span></legend>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ($m::SECTORS as $value => $label)
                            <label class="aa-apply-check cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="sectors[]"
                                    value="{{ $value }}"
                                    class="shrink-0 sector-option"
                                    data-sector="{{ $value }}"
                                    {{ in_array($value, old('sectors', []), true) ? 'checked' : '' }}
                                />
                                <span class="text-sm text-gray-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div id="sectors-other-wrap" class="mt-3 {{ in_array('other', old('sectors', []), true) ? '' : 'hidden' }}">
                        <label for="sectors_other" class="block text-sm font-medium text-gray-800">Please specify (Other)</label>
                        <input
                            type="text"
                            id="sectors_other"
                            name="sectors_other"
                            maxlength="500"
                            value="{{ old('sectors_other') }}"
                            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 shadow-sm focus:border-[#0a5c50] focus:ring-2 focus:ring-[#36b37e]/40"
                        />
                    </div>
                </fieldset>

                <fieldset class="aa-apply-fieldset space-y-2 rounded-xl border border-[#e2f0ea] bg-white/60 p-4 sm:p-5">
                    <legend>What cheque size would you realistically be comfortable deploying?</legend>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ($m::CHEQUE_SIZE as $value => $label)
                            <label class="aa-apply-check cursor-pointer">
                                <input
                                    type="radio"
                                    name="cheque_size"
                                    value="{{ $value }}"
                                    class="shrink-0"
                                    {{ old('cheque_size') === $value ? 'checked' : '' }}
                                    @if ($loop->first) required @endif
                                />
                                <span class="text-sm text-gray-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-col gap-3 border-t border-[#e2f0ea] bg-[#f9fdfb] px-4 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <p class="text-xs text-gray-500">By submitting, you agree we may contact you about this application.</p>
                <button
                    type="submit"
                    class="inline-flex min-h-[48px] w-full items-center justify-center rounded-full bg-[#042f28] px-8 text-sm font-bold text-white shadow-lg shadow-emerald-950/25 transition hover:-translate-y-0.5 hover:bg-[#063d36] active:scale-[0.98] sm:w-auto sm:min-w-[11rem]"
                >
                    Submit application
                </button>
            </div>
        </form>
    </section>
</div>

<script>
    (function () {
        var otherWrap = document.getElementById('sectors-other-wrap');
        var otherInput = document.getElementById('sectors_other');
        function syncOther() {
            var checked = document.querySelector('.sector-option[data-sector="other"]:checked');
            if (!otherWrap) return;
            if (checked) {
                otherWrap.classList.remove('hidden');
                if (otherInput) otherInput.required = true;
            } else {
                otherWrap.classList.add('hidden');
                if (otherInput) { otherInput.required = false; }
            }
        }
        document.querySelectorAll('.sector-option').forEach(function (el) {
            el.addEventListener('change', syncOther);
        });
        syncOther();
    })();
</script>
@endsection
