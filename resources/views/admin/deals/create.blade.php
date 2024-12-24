@extends('layouts.admin')
@section('page_title','Add a new member | Bangladesh Angels Network')
@section('page_content')
<section class="container mx-auto px-6 py-12 bg-white rounded-lg shadow-lg mt-8">
  <header class="flex justify-between items-center mb-8">
      <div>
          <h1 class="text-2xl font-bold">Add New Deal</h1>
          <p class="text-gray-500">Dashboard &gt; Deals &gt; Add new deal</p>
      </div>
      <div class="flex space-x-4">
          <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg shadow">Save as draft</button>
          <button class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Add new deal</button>
      </div>
  </header>

  <form action="{{ route('deals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf

      <!-- Deal Information -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Upload Logo -->
          <div class="text-center border-dashed border-2 border-gray-300 rounded-lg p-6">
              <label class="block cursor-pointer">
                  <div class="mb-4">
                      <img src="https://via.placeholder.com/150" alt="Upload Placeholder" class="mx-auto rounded-full h-24 w-24">
                  </div>
                  <input type="file" name="logo" accept="image/*" class="hidden">
                  <p class="text-gray-500 text-sm">Upload logo</p>
                  <p class="text-gray-400 text-xs">Allowed: *.jpeg, *.png, *.gif (Max: 3.1 MB)</p>
              </label>
          </div>

          <!-- Input Fields -->
          <div class="md:col-span-2 space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <input type="text" name="company_name" placeholder="Company Name" class="input-field" required>
                  <input type="text" name="sector" placeholder="Sector" class="input-field" required>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <select name="investment_stage" class="input-field" required>
                      <option value="">Investment Stage</option>
                      <option value="Pre Seed">Pre Seed</option>
                      <option value="Seed">Seed</option>
                      <option value="Series A">Series A</option>
                      <option value="Growth">Growth</option>
                  </select>
                  <input type="number" name="amount_seeking" placeholder="Amount Seeking" class="input-field" required>
              </div>
              <textarea name="description" placeholder="Description" rows="4" class="input-field" required></textarea>
          </div>
      </div>

      <!-- Company Cover -->
      <div class="border-dashed border-2 border-gray-300 rounded-lg p-6">
          <label class="block cursor-pointer text-center">
              <div class="mb-4">
                  <img src="https://via.placeholder.com/150" alt="Upload Placeholder" class="mx-auto rounded-lg">
              </div>
              <input type="file" name="company_cover" accept="image/*" class="hidden">
              <p class="text-gray-500 text-sm">Attach Files</p>
              <p class="text-gray-400 text-xs">Drop files here or click <span class="text-blue-500 underline">browse</span> through your machine</p>
          </label>
      </div>

      <!-- Key Metrics -->
      <div>
          <h2 class="text-lg font-bold mb-4">Key Metrics</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <input type="text" name="key_metrics[growth_traction]" placeholder="Growth Traction" class="input-field">
              <input type="text" name="key_metrics[impact_metrics]" placeholder="Impact Metrics" class="input-field">
              <input type="text" name="key_metrics[future_plans]" placeholder="Future Plans" class="input-field">
              <input type="text" name="key_metrics[partnerships]" placeholder="Partnerships" class="input-field">
              <input type="text" name="key_metrics[revenue_highlights]" placeholder="Revenue Highlights" class="input-field">
              <input type="text" name="key_metrics[market_opportunity]" placeholder="Market Opportunity" class="input-field">
          </div>
      </div>

      <div class="text-right">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">Add Deal</button>
      </div>
  </form>
</section>

<style>
  .input-field {
      border: 1px solid #e2e8f0;
      padding: 0.5rem;
      border-radius: 0.375rem;
      width: 100%;
      background-color: #f9fafb;
  }

  .input-field:focus {
      outline: none;
      border-color: #34d399;
      box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.5);
  }
</style>

@endsection