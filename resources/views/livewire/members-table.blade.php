<div>
    <!-- Filters and Search -->
    <div class="p-4 md:p-6 bg-white shadow mt-4">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <a wire:click="setFilter('all')" class="px-4 py-2 cursor-pointer {{ $filter === 'all' ? 'bg-green-100 text-green-700 font-semibold rounded-lg' : 'text-gray-500 hover:text-green-700' }}">
                    All <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $filter === 'all' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $allCount }}</span>
                </a>
                <a wire:click="setFilter('active')" class="px-4 py-2 cursor-pointer {{ $filter === 'active' ? 'bg-green-100 text-green-700 font-semibold rounded-lg' : 'text-gray-500 hover:text-green-700' }}">
                    Active <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $filter === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $activeCount }}</span>
                </a>
                <a wire:click="setFilter('inactive')" class="px-4 py-2 cursor-pointer {{ $filter === 'inactive' ? 'bg-green-100 text-green-700 font-semibold rounded-lg' : 'text-gray-500 hover:text-green-700' }}">
                    Inactive <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $filter === 'inactive' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $inactiveCount }}</span>
                </a>
                <a wire:click="setFilter('pending')" class="px-4 py-2 cursor-pointer {{ $filter === 'pending' ? 'bg-green-100 text-green-700 font-semibold rounded-lg' : 'text-gray-500 hover:text-green-700' }}">
                    Pending Approval <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $filter === 'pending' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $pendingCount }}</span>
                </a>
            </div>

            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto relative items-center">
                <!-- Loading Indicator -->
                <div wire:loading wire:target="searchUsers" class="absolute left-[-40px]">
                    <img src="{{asset('loading.gif')}}" alt="Loading..." class="h-6 w-6">
                </div>
            
                <!-- Search Input -->
                <input type="text" 
                    wire:model.defer="search"
                    wire:keydown.enter="searchUsers"
                    placeholder="Search members..."
                    class="border-gray-300 rounded-lg shadow-sm px-4 py-2 md:w-64 focus:ring-green-500 focus:border-green-500">
            
                <!-- Search Button -->
                <button wire:click="searchUsers"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:ring focus:ring-green-300 transition duration-200">
                    Search
                </button>
            </div>
            
        </div>
    </div>

    <!-- Members Table -->
    <div class="p-4 md:p-6 bg-white shadow mt-4 overflow-x-auto">
        <div class="min-w-[320px] md:w-full">
            <table class="w-full border-collapse text-left text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="pl-4 pr-2 md:px-6 py-4 font-medium text-gray-600">Member</th>
                        <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">Designation</th>
                        <th class="hidden lg:table-cell px-6 py-4 font-medium text-gray-600">Organization</th>
                        <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">Phone</th>
                        <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">
                            @if($filter === 'pending')
                                Registered
                            @else
                                Last Renewed
                            @endif
                        </th>
                        <th class="pl-2 pr-4 md:px-6 py-4 font-medium text-gray-600">Status</th>
                        <th class="px-4 md:px-6 py-4 font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="pl-4 pr-2 md:px-6 py-4">
                                <div class="flex items-center gap-2 md:gap-4">
                                    <img src="{{ $user->getProfilePhotoUrl() }}" alt="Profile" class="w-8 h-8 md:w-10 md:h-10 rounded-full">
                                    <div class="min-w-[120px]">
                                        <p class="font-medium inline-flex items-center gap-2 flex-wrap">
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                                <span class="text-xs font-normal px-2 py-0.5 rounded-full bg-gray-200 text-gray-700">You</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            @if($filter === 'pending')
                                                Location: {{ $user->primary_country ?? '-' }}
                                            @else
                                                Joined: {{ $user->joining_date ?? $user->created_at->format('M d, Y') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4">{{ $user->designation ?? '-' }}</td>
                            <td class="hidden lg:table-cell px-6 py-4">{{ $user->company_name ?? '-' }}</td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">{{ $user->phone ?? '-' }}</td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                @if($filter === 'pending')
                                    <div class="flex flex-col gap-1">
                                        <span class="text-xs text-gray-500">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $user->created_at->diffForHumans() }}
                                        </span>
                                        @if($user->approved_at)
                                        <span class="text-xs text-green-600 mt-1 inline-flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Approved {{ $user->approved_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </div>
                                @else
                                    {{ $user->last_renewed_at ? \Carbon\Carbon::parse($user->last_renewed_at)->format('jS F, Y') : '-' }}
                                @endif
                            </td>
                            <td class="pl-2 pr-4 md:px-6 py-4">
                                @if($filter === 'pending')
                                <span class="px-2 py-1 rounded-full text-xs md:text-sm bg-yellow-100 text-yellow-800">
                                    Pending Approval
                                </span>
                                @else
                                <span class="px-2 py-1 rounded-full text-xs md:text-sm 
                                    {{ $user->account_status !== 'free' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->account_status) }}
                                </span>
                                @endif
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('member.edit', $user->id) }}" class="text-gray-600 hover:text-green-700 p-1">
                                        Edit
                                    </a>
                                    @if($filter === 'pending' && !$user->is_approved)
                                    <button 
                                        wire:click="approveUser({{ $user->id }})"
                                        wire:loading.attr="disabled"
                                        class="bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-xs">
                                        Approve
                                    </button>
                                    @endif
                                    @if($user->id != auth()->id())
                                    <a href="{{ route('member.remove', $user->id) }}" 
                                       onclick="return confirm('Are you sure you want to delete this member? This action cannot be undone.')"
                                       class="text-red-600 hover:text-red-800 p-1 ml-2">
                                        Delete
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6 px-4 md:px-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
