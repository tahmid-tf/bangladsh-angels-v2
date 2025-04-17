<?php

namespace App\Livewire;

use Livewire\Component;

class NavigationBar extends Component
{
    public function sendVerificationEmail()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return;
        }

        auth()->user()->sendEmailVerificationNotification();
        
        session()->flash('verification-notice', 'A new verification link has been sent to your email address.');
    }
    
    public function render()
    {
        return view('livewire.navigation-bar');
    }
}
