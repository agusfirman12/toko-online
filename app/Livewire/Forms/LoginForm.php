<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginForm extends Form
{
    #[Rule('required','email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public function login(){
        if (Auth::attempt($this->validate())) {
            if(Auth::user()->HasRole('admin')){
                return redirect()->route('admin.dashboard');
            }elseif(Auth::user()->HasRole('seller')){
                return redirect()->route('seller.dashboard');
            }
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
