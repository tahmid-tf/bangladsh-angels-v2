@extends('layouts.guest')
@section('page_title','Our Investors | Bangladesh Angel Investors Limited')
@section('page_content')
<div class="w-full max-w-6xl mx-auto px-4 sm:px-6">
    {{-- Hero: aligned with investor signup / register guest styling --}}
    <section class="bg-[#0a5554] rounded-3xl py-10 sm:py-12 text-white shadow-lg mb-8 sm:mb-10">
        <div class="container mx-auto px-6 lg:flex lg:items-center lg:justify-between lg:gap-12">
            <div class="lg:w-1/2">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 tracking-tight">Our Angel Investors</h1>
                <p class="text-base sm:text-lg leading-relaxed text-white/90">
                    Join a global network of executives and operators who have built and expanded companies all over the world.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                    <a href="{{ route('investor.signup') }}"
                       class="inline-flex items-center justify-center px-6 py-3 rounded-lg font-semibold text-sm sm:text-base bg-white text-[#0a5554] shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0a5554] transition">
                        Become an Investor
                    </a>
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center text-sm sm:text-base text-white/90 underline underline-offset-4 hover:text-white transition">
                            Or register for an account
                        </a>
                    @endguest
                </div>
            </div>
            <div class="lg:w-1/2 mt-8 lg:mt-0">
                <img src="{{ asset('investor_cover.webp') }}" alt="Investors" class="w-full h-auto rounded-xl shadow-md" width="640" height="400" loading="eager">
            </div>
        </div>
    </section>
</div>

<section class="container mx-auto px-4 sm:px-6 py-4 sm:py-8">
    <p class="text-center text-gray-600 mb-8 sm:mb-10 max-w-3xl mx-auto">
        Meet a selection of members featured by Bangladesh Angels Network. Use the search below to filter by name or role.
    </p>

    <!-- Search & Filter Section -->
    <div class="mb-8 max-w-2xl mx-auto">
        <div class="flex flex-col sm:flex-row gap-4 bg-white p-4 rounded-lg shadow border border-gray-100">
            <div class="flex-1">
                <input type="text" id="investorSearch" placeholder="Search investors..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="flex-none">
                <select id="industryFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">All Industries</option>
                    <option value="tech">Technology</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <div id="investor-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

        @forelse ($investors as $investor)
            <div class="investor-grid-card bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="p-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                        <img src="{{ $investor->getProfilePhotoUrl() }}" alt="{{ $investor->name }}"
                            class="w-20 h-20 rounded-full mx-auto sm:mx-0 object-cover border-2 border-gray-100">
                        <div class="text-center sm:text-left">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $investor->name }}</h3>
                            <p class="text-gray-600">{{ $investor->designation }}{{ ($investor->company_name) ? ', ' . $investor->company_name : '' }}</p>
                        </div>
                    </div>

                    <div class="border-t pt-4 mt-2">
                        <div class="flex flex-wrap justify-between items-center">
                            @if ($investor->joining_date)
                                <p class="text-gray-500 text-sm mb-2 sm:mb-0">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    Member Since: {{ $investor->joining_date }}
                                </p>
                            @endif
                            @if ($investor->linkedin)
                                <a href="{{ $investor->linkedin }}" target="_blank" rel="noopener"
                                   class="text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1 group">
                                    <i class="fab fa-linkedin"></i>
                                    <span class="group-hover:underline">LinkedIn</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="investor-grid-card col-span-full text-center py-12 px-4 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                <p class="text-gray-600 text-lg font-medium">Featured investors will appear here soon.</p>
                <p class="mt-2 text-gray-500 text-sm max-w-md mx-auto">We showcase selected members on this page. Interested in joining the network?</p>
                <a href="{{ route('investor.signup') }}" class="inline-flex mt-6 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                    Become an Investor
                </a>
            </div>
        @endforelse
    </div>

    @if(isset($investors) && method_exists($investors, 'links'))
        <div class="mt-8">
            {{ $investors->links() }}
        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('investorSearch');
        const industryFilter = document.getElementById('industryFilter');
        const grid = document.getElementById('investor-grid');
        if (!grid) return;

        function getCards() {
            return grid.querySelectorAll('.investor-grid-card');
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterInvestors);
        }

        if (industryFilter) {
            industryFilter.addEventListener('change', filterInvestors);
        }

        function filterInvestors() {
            const searchTerm = (searchInput && searchInput.value.toLowerCase()) || '';
            const industry = (industryFilter && industryFilter.value.toLowerCase()) || '';
            const investorCards = getCards();

            investorCards.forEach(card => {
                const name = card.querySelector('h3')?.textContent.toLowerCase() || '';
                const position = card.querySelector('p.text-gray-600')?.textContent.toLowerCase() || '';
                const matchesSearch = searchTerm === '' ||
                    name.includes(searchTerm) ||
                    position.includes(searchTerm);
                const matchesIndustry = industry === '' || position.includes(industry);

                card.style.display = (matchesSearch && matchesIndustry) ? '' : 'none';
            });
        }
    });
</script>
@endsection
