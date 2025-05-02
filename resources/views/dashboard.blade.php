<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!auth()->user()->is_approved)
                <!-- Message for unapproved users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-800">Account Under Review</h3>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <p class="text-gray-700 mb-4">Thank you for registering with Bangladesh Angels Network. Your account is currently under review by our team.</p>
                            
                            <p class="text-gray-600 mb-4">This process typically takes 1-2 business days. During this time, our team verifies your details to ensure a secure and trusted community for all our members.</p>
                            
                            <p class="text-gray-600">Once your account is approved, you'll gain full access to all features including deals, resources, and our investor network.</p>
                        </div>

                        <div class="mt-6">
                            <h4 class="font-medium text-gray-700 mb-2">What happens next?</h4>
                            <ul class="list-disc pl-5 text-gray-600 space-y-1">
                                <li>You'll receive an email notification when your account has been approved</li>
                                <li>You can then access all of our platform features</li>
                                <li>Your dashboard will be updated with investment opportunities</li>
                            </ul>
                        </div>

                        <div class="mt-6 text-sm text-gray-500">
                            If you have any questions, please contact our support team at 
                            <a href="mailto:support@bdangels.co" class="text-blue-600 hover:underline">support@bdangels.co</a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Content for approved users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col p-6 text-gray-900">
                        <span class="flex">
                            <strong>Your Investment Portfolio (</strong>{{auth()->user()->investments->count()}})
                        </span>
                        <!-- Table -->
                        <div class="flex flex-col md:flex-row bg-white rounded-lg mt-6 shadow overflow-x-auto">
                            @foreach (auth()->user()->investments as $investment)
                                <span class="w-full md:w-1/3 m-3">
                                    <livewire:deal-card :deal="$investment->deal"></livewire:deal-card>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
