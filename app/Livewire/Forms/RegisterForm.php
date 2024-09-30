<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Rule;


class RegisterForm extends Form
{

    #[Rule(['required'])]
    public string $name = '';

    #[Rule(['required', 'email'])]
    public string $email = '';

    // #[Rule(['numeric'])]
    public $handphone;

    #[Rule(['min:5'])]
    public string $address = '';

    #[Rule(['required'])]
    public string $password = '';

    public function store(){
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'handphone' => $this->handphone,
            'address' => $this->address,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole('user');
        
        session()->flash('successRegister', 'Berhasil mendaftar!');
        
        return redirect()->route('login');
    }
}
