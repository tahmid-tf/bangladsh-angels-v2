<?php

namespace App\Livewire;

use Livewire\Component;

class DealActionButton extends Component
{
    public $deal;
    
    public function render()
    {
        return view('livewire.deal-action-button');
    }
}
