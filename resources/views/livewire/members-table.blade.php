<div>
    <!-- Filters and Search -->
    <div class="p-4 md:p-6 bg-white shadow mt-4">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <a href="{{route('admin.members')}}" class="px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-lg">All</a>
                <a href="{{route('admin.active.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Active</a>
                <a href="{{route('admin.inactive.members')}}" class="px-4 py-2 text-gray-500 hover:text-green-700">Inactive</a>
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
                        <th class="hidden md:table-cell px-6 py-4 font-medium text-gray-600">Last Renewed</th>
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
                                        <p class="font-medium">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Joined: {{ $user->joining_date }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4">{{ $user->designation ?? '-' }}</td>
                            <td class="hidden lg:table-cell px-6 py-4">{{ $user->company_name ?? '-' }}</td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">{{ $user->phone ?? '-' }}</td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                {{ $user->last_renewed_at ? \Carbon\Carbon::parse($user->last_renewed_at)->format('jS F, Y') : '-' }}
                            </td>
                            <td class="pl-2 pr-4 md:px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs md:text-sm 
                                    {{ $user->account_status !== 'free' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->account_status) }}
                                </span>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('member.edit', $user->id) }}" class="text-gray-600 hover:text-green-700 p-1">
                                        Edit
                                    </a>
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
