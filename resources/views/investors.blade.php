@extends('layouts.guest')
@section('page_title','Our Investors | Bangladesh Angel Investors Limited')
@section('page_content')
<section class="container mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <h1 class="text-3xl sm:text-4xl font-bold text-center mb-3 sm:mb-4">Our Angel Investors</h1>
    <p class="text-center text-gray-600 mb-8 sm:mb-12 max-w-3xl mx-auto">
        Join a Global network of over 450 executives and operators who have built and expanded companies all over the world.
    </p>

    <!-- Search & Filter Section -->
    <div class="mb-8 max-w-2xl mx-auto">
        <div class="flex flex-col sm:flex-row gap-4 bg-white p-4 rounded-lg shadow">
            <div class="flex-1">
                <input type="text" id="investorSearch" placeholder="Search investors..." 
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex-none">
                <select id="industryFilter" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Industries</option>
                    <option value="tech">Technology</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        
        @forelse ($investors as $investor)
            <!-- Investor Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
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
                                <a href="{{$investor->linkedin}}" target="_blank" rel="noopener" 
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
            <div class="col-span-full text-center py-10">
                <div class="text-gray-500 text-lg">No investors found</div>
                <p class="mt-2">Check back soon as our network grows!</p>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination (if needed) -->
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
        const investorCards = document.querySelectorAll('.grid > div');
        
        // Simple search function (frontend only)
        // For production, consider implementing server-side filtering
        if (searchInput) {
            searchInput.addEventListener('input', filterInvestors);
        }
        
        if (industryFilter) {
            industryFilter.addEventListener('change', filterInvestors);
        }
        
        function filterInvestors() {
            const searchTerm = searchInput.value.toLowerCase();
            const industry = industryFilter.value.toLowerCase();
            
            // Implement actual filtering logic based on your data model
            // This is just a placeholder
        }
    });
</script>
@endsection