<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class MembersTable extends Component
{
    use WithPagination;

    public $search = ''; // Search term

    protected $queryString = ['search']; // Preserve search in the URL

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination on new search
    }

    public function searchUsers()
    {
        $this->render(); // Manually refresh the component when search is triggered
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('designation', 'like', "%{$this->search}%")
                      ->orWhere('company_name', 'like', "%{$this->search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.members-table', compact('users'));
    }
}
