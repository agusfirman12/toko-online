<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class ModalEditUsers extends Component
{
    public $name, $email, $userId;

    #[On('loadUser')]
    public function loadUser($id){
        $user = User::find($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser(){
        $user = User::find($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->update();
        
        $this->dispatch('updateListUsers');

        session()->flash('successEditUser', 'User Updated!');

        $this->dispatch('close-modal');
    }
    public function render()
    {
        return view('livewire.admin.users.modal-edit-users');
    }
}
