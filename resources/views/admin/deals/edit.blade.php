@extends('layouts.admin')
@section('page_title','Edit Deal | Bangladesh Angels Network')
@section('page_content')
<section class="container mx-auto px-4 py-8 bg-white rounded-lg shadow-md">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold mb-1">Edit Deal</h1>
            <p class="text-sm text-gray-500">Dashboard &gt; Deals &gt; Edit Deal</p>
        </div>
        <div class="flex">
            <form action="{{ route('delete.deal', $deal->id) }}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-4 mr-6 md:mt-0 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
            <button type="submit" form="deal-form" class="mt-4  md:mt-0 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Update Deal
            </button>
            
            
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this deal? This action cannot be undone.");
                }
            </script>
        </div>
        
        
    </header>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="deal-form" action="{{ route('update.deal', $deal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Responsive Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Logo Upload -->
            <div class="border-dashed border-2 border-gray-300 rounded-lg p-4">
                <label class="block cursor-pointer">
                    <img 
                        id="logo-preview" 
                        src="{{ $deal->getLogoUrl() }}" 
                        alt="Current Logo" 
                        class="mx-auto rounded-full h-24 w-24 object-cover mb-2"
                    >
                    <input type="file" name="logo" accept="image/*" class="hidden" id="logo-input">
                    <p class="text-center text-sm text-gray-500">Replace logo</p>
                    <p class="text-center text-xs text-gray-400">Max size: 3MB, Formats: JPEG, PNG, GIF</p>
                </label>
            </div>

            <!-- Cover Upload -->
            <div class="border-dashed border-2 border-gray-300 rounded-lg p-4">
                <label class="block cursor-pointer">
                    <img 
                        id="cover-preview" 
                        src="{{ $deal->getCoverUrl() }}" 
                        alt="Current Cover" 
                        class="mx-auto rounded-lg h-40 w-full object-cover mb-2"
                    >
                    <input type="file" name="company_cover" accept="image/*" class="hidden" id="cover-input">
                    <p class="text-center text-sm text-gray-500">Replace cover</p>
                    <p class="text-center text-xs text-gray-400">Max size: 3MB, Formats: JPEG, PNG, GIF</p>
                </label>
            </div>

            
        </div>

        <!-- Deal Details -->
        <div class="mt-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title *</label>
                    <input type="text" id="title" name="title" class="input-field" value="{{ old('title', $deal->title) }}" required>
                </div>

                
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Deal Type -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">Deal Type *</label>
                    <select id="type" name="type" class="input-field" required>
                        <option value="commit" {{ old('type', $deal->type) == 'commit' ? 'selected' : '' }}>Commit</option>
                        <option value="invest" {{ old('type', $deal->type) == 'invest' ? 'selected' : '' }}>Invest</option>
                        <option value="review" {{ old('type', $deal->type) == 'review' ? 'selected' : '' }}>Review</option>
                        <option value="portfolio" {{ old('type', $deal->type) == 'portfolio' ? 'selected' : '' }}>Portfolio</option>
                    </select>
                </div>
                <!-- Deal Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status *</label>
                    <select id="status" name="status" class="input-field" required>
                        <option value="active" {{ old('type', $deal->type) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="closed" {{ old('type', $deal->type) == 'closed' ? 'selected' : '' }}>Closed</option>
                        <option value="draft" {{ old('type', $deal->type) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <!-- Investment Stage -->
                <div>
                    <label for="investment_stage" class="block text-sm font-semibold text-gray-700 mb-1">Investment Stage</label>
                    <select id="investment_stage" name="investment_stage" class="input-field">
                        <option value="Pre Seed" {{ old('investment_stage', $deal->investment_stage) == 'Pre Seed' ? 'selected' : '' }}>Pre Seed</option>
                        <option value="Seed" {{ old('investment_stage', $deal->investment_stage) == 'Seed' ? 'selected' : '' }}>Seed</option>
                        <option value="Series A" {{ old('investment_stage', $deal->investment_stage) == 'Series A' ? 'selected' : '' }}>Series A</option>
                        <option value="Series B" {{ old('investment_stage', $deal->investment_stage) == 'Series B' ? 'selected' : '' }}>Series B</option>
                        <option value="Series C" {{ old('investment_stage', $deal->investment_stage) == 'Series C' ? 'selected' : '' }}>Series C</option>
                        <option value="Series D" {{ old('investment_stage', $deal->investment_stage) == 'Series D' ? 'selected' : '' }}>Series D</option>
                    </select>
                </div>
            </div>

            <!-- Sector -->
            <div>
                <label for="sector" class="block text-sm font-semibold text-gray-700 mb-1">Sector *</label>
                <input type="text" id="sector" name="sector" class="input-field" value="{{ old('sector', $deal->sector) }}" required>
            </div>

            <!-- Amount Seeking -->
            <div>
                <label for="amount_seeking" class="block text-sm font-semibold text-gray-700 mb-1">Amount Seeking *</label>
                <input type="number" id="amount_seeking" name="amount_seeking" class="input-field" value="{{ old('amount_seeking', $deal->amount_seeking) }}" >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description *</label>
                <textarea id="description" name="description" class="input-field" rows="4" required>{{ old('description', $deal->description) }}</textarea>
            </div>
        </div>

        <!-- External Links -->
        <div class="mt-6 space-y-4">
            <div>
                <label for="pitch_deck_url" class="block text-sm font-semibold text-gray-700 mb-1">Pitch Deck URL *</label>
                <input type="text" id="pitch_deck_url" name="pitch_deck_url" class="input-field" value="{{ old('pitch_deck_url', $deal->pitch_deck_url) }}">
            </div>
            <div>
                <label for="substack_link" class="block text-sm font-semibold text-gray-700 mb-1">Substack URL</label>
                <input type="text" id="substack_link" name="substack_link" class="input-field" value="{{ old('substack_link', $deal->substack_link) }}">
            </div>
            <div>
                <label for="invest_link" class="block text-sm font-semibold text-gray-700 mb-1">Invest Link</label>
                <input type="text" id="invest_link" name="invest_link" class="input-field" value="{{ old('invest_link', $deal->invest_link) }}">
            </div>
            <div>
                <label for="commit_link" class="block text-sm font-semibold text-gray-700 mb-1">Commit Link</label>
                <input type="text" id="commit_link" name="commit_link" class="input-field" value="{{ old('commit_link', $deal->commit_link) }}">
            </div>
            <div>
                <label for="groupchat_invite_link" class="block text-sm font-semibold text-gray-700 mb-1">Groupchat Invite Link</label>
                <input type="text" id="groupchat_invite_link" name="groupchat_invite_link" class="input-field" value="{{ old('groupchat_invite_link', $deal->groupchat_invite_link) }}">
            </div>
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
