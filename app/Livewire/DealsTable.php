<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Deal;

class DealsTable extends Component
{
    use WithPagination;

    public $search = '';
    
    protected $queryString = ['search']; // Keeps search in the URL

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination on new search
    }

    public function searchDeals()
    {
        $this->resetPage(); // Reset pagination
    }

    public function render()
    {
        $deals = Deal::where('title', 'like', "%{$this->search}%")
            ->orWhere('description', 'like', "%{$this->search}%")
            ->orWhere('sector', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.deals-table', [
            'deals' => $deals
        ]);
    }
}
