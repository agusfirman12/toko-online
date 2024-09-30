<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.seller.dashboard');
    }
}
