@extends('layouts.admin')

@section('page_title', 'Edit Investor Investment')

@section('page_content')
<section class="container mx-auto p-4 md:p-6 max-w-5xl">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <a href="{{ route('admin.investor-investments.show', $investorInvestment) }}" class="text-sm font-semibold text-[#0a5554] hover:underline">← Back to investment</a>
        <h1 class="mt-3 text-lg md:text-xl font-bold text-gray-900">Edit investment</h1>
        <p class="mt-1 text-sm text-gray-600">Update the linked profiles or completed transaction details.</p>
    </div>

    @include('admin.investor-investments.form', [
        'action' => route('admin.investor-investments.update', $investorInvestment),
        'method' => 'PUT',
        'submitLabel' => 'Save changes',
    ])
</section>
@endsection
