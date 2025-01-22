<?php

namespace App\Livewire;

use Livewire\Component;

class DealCard extends Component
{
    public $deal;

    public function render()
    {
        return view('livewire.deal-card');
    }
}
