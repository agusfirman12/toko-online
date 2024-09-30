<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;


#[Layout('Layouts.dashboard')]

class Users extends Component
{    
    public function render()
    {

        return view('livewire.admin.users.index');
    }
}
