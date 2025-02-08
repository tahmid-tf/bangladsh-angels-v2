<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        </div>
    </div>
</x-app-layout>
