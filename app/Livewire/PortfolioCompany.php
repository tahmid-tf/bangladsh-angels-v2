<?php

namespace App\Livewire;

use Livewire\Component;


class PortfolioCompany extends Component
{
    public $deal;
    
    public function render()
    {
        return view('livewire.portfolio-company');
    }
}
