<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\LoginForm;

#[Layout('layouts.guest')]

#[Title('Login')]

class Login extends Component
{
    public LoginForm $form;

    public function login(){

        $this->form->login();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
