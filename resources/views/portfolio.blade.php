@extends('layouts.guest')
@section('page_title','Portfolio | Bangladesh Angel Investors Ltd.')
@section('page_content')
<section class="container mx-auto px-6 py-12">
    <header class="mb-8">
        <h1 class="text-3xl font-bold">Portfolio Companies</h1>
        <p class="text-gray-600">Take a look at our portfolio companies</p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($deals as $deal)
        <livewire:deal-card :deal="$deal"></livewire:deal-card>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{-- {{ $deals->links() }} --}}
    </div>
</section>
@endsection