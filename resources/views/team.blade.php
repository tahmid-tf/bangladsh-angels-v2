@extends('layouts.guest')
@section('page_title', 'Our Team | Bangladesh Angels Network Limited')

@push('head_meta')
    <x-seo-meta
        title="Our Team | Bangladesh Angels Network Limited"
        description="Meet Bangladesh Angels Network (BAN) — Bangladesh’s first and largest angel investing platform connecting founders with investors, mentorship, and capital."
        :canonical="route('team')"
        :image="asset('DI4A6345.jpg')"
    />
@endpush

@section('page_content')
<!-- Section: Header -->
<section class="container mx-auto mt-16 px-6 lg:flex lg:space-x-12">
    <!-- Left: Images -->
    <div class="lg:w-1/2 grid grid-cols-1 lg:grid-cols-2 gap-6 items-center justify-center">
        <img src="{{asset('DI4A6345.jpg')}}" alt="Handshake" class="rounded-xl w-full h-auto object-cover">
        <img src="{{asset('DSC00467.jpg')}}" alt="Team Photo" class="rounded-xl w-full h-auto object-cover shadow-lg">
    </div>

    <!-- Right: Text Content -->
    <div class="mt-12 lg:mt-0 lg:w-1/2 flex items-center">
        <div>
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6 leading-tight">
                What is Bangladesh Angels Network?
            </h2>
            <p class="text-lg leading-relaxed text-gray-600">
                Bangladesh Angels Network (BAN) is the country’s first and largest angel investing platform, connecting visionary entrepreneurs with seasoned investors, fostering an ecosystem that drives innovation and economic growth.
                <br><br>With $21.7M+ USD invested across 50+ startups, we provide capital, mentorship, and strategic backing to early-stage companies that are solving real problems and scaling fast. Our network is a mix of local and global investors, business leaders, and founders who collaborate to unlock market-changing opportunities. We don’t just invest, we build, nurture, and accelerate ventures that have the potential to reshape industries. Whether you're looking to back or build the next industry-defining company, BAN is where it happens.

            </p>
        </div>
    </div>
</section>



<!-- Section: Team and Management -->
<section class="container mx-auto mt-20 px-6">
    <h2 class="text-center text-3xl md:text-4xl font-extrabold text-[#0f3d34] mb-4">Team &amp; Management</h2>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12 leading-relaxed">
        The people running day-to-day programs, partnerships, and operations at Bangladesh Angels Network.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 max-w-5xl mx-auto">
        @forelse ($management as $member)
            <x-team-member-card :member="$member" />
        @empty
            <p class="col-span-full text-center text-gray-600 py-8">No team members are listed yet.</p>
        @endforelse
    </div>
</section>



<!-- Section: Governing Board -->
<section class="container mx-auto mt-20 px-6 mb-16">
    <h2 class="text-center text-3xl md:text-4xl font-extrabold text-[#0f3d34] mb-4">Governing Board</h2>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12 leading-relaxed">
        Advisors and leaders who help steer the network’s governance and long-term direction.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 max-w-5xl mx-auto">
        @forelse ($governingBoard as $member)
            <x-team-member-card :member="$member" />
        @empty
            <p class="col-span-full text-center text-gray-600 py-8">No governing board members are listed yet.</p>
        @endforelse
    </div>
</section>

@endsection