<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class MembersTable extends Component
{
    use WithPagination;

    public $search = ''; // Search term
    public $filter = 'all'; // Filter: all, active, inactive, pending
    public $allCount;
    public $activeCount;
    public $inactiveCount;
    public $pendingCount;

    protected $queryString = ['search', 'filter']; // Preserve search and filter in the URL

    public function mount()
    {
        // Initialize counts
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->allCount = User::where('id', '!=', auth()->id())->where('is_approved', true)->count();
        $this->activeCount = User::where('id', '!=', auth()->id())->where('account_status', '!=', 'free')->where('is_approved', true)->count();
        $this->inactiveCount = User::where('id', '!=', auth()->id())->where('account_status', 'free')->where('is_approved', true)->count();
        $this->pendingCount = User::where('id', '!=', auth()->id())->where('is_approved', false)->count();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination on new search
    }

    public function updatingFilter()
    {
        $this->resetPage(); // Reset pagination on filter change
    }

    public function searchUsers()
    {
        $this->render(); // Manually refresh the component when search is triggered
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function approveUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update([
                'is_approved' => true,
                'approved_by' => auth()->id(),
                'approved_at' => now()
            ]);
            
            // Update counts after approving a user
            $this->updateCounts();
        }
    }

    public function render()
    {
        $query = User::where('id', '!=', auth()->id());

        // Apply filter
        switch ($this->filter) {
            case 'active':
                $query->where('account_status', '!=', 'free')->where('is_approved', true);
                break;
            case 'inactive':
                $query->where('account_status', 'free')->where('is_approved', true);
                break;
            case 'pending':
                $query->where('is_approved', false);
                break;
            default: // 'all'
                $query->where('is_approved', true);
                break;
        }

        // Apply search
        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('designation', 'like', "%{$this->search}%")
                    ->orWhere('company_name', 'like', "%{$this->search}%");
            });
        }

        // Apply different sorting based on filter
        if ($this->filter === 'pending') {
            // Sort pending approval users by latest first
            $users = $query->orderBy('created_at', 'desc')->paginate(10);
        } else {
            // Default sorting for other tabs
            $users = $query->orderBy('name', 'asc')->paginate(10);
        }

        return view('livewire.members-table', compact('users'));
    }
}
