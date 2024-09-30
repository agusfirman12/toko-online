<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\RegisterForm;

#[Layout('layouts.guest')]

#[Title('Register')]

class Register extends Component
{

    public RegisterForm $form;

    public function register(){
        
        $this->form->store();
        
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
