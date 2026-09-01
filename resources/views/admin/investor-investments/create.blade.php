@extends('layouts.admin')

@section('page_title', 'Record Investor Investment')

@section('page_content')
<section class="container mx-auto p-4 md:p-6 max-w-5xl">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <a href="{{ route('admin.investor-investments.index') }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to investors investments</a>
        <h1 class="mt-3 text-lg md:text-xl font-bold text-gray-900">Record an investment</h1>
        <p class="mt-1 text-sm text-gray-600">Select an existing investor and startup, then enter the completed transaction details.</p>
    </div>

    @include('admin.investor-investments.form', [
        'action' => route('admin.investor-investments.store'),
        'method' => 'POST',
        'submitLabel' => 'Record investment',
    ])
</section>
@endsection
