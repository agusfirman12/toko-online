<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class UserList extends Component
{


    public function loadUser($id){
        $this->dispatch('loadUser', $id);
    }

    #[On('deleteUser')]
    public function deleteUser($id){
        User::find($id)->delete();
        
        session()->flash('successDeleteUser', 'User Deleted!');
        
        $this->dispatch('updateListUsers');
    }

    #[On('updateListUsers')]
    public function updateListUsers(){
    }

    public function render()
    {
        $users = User::with('role')->paginate(3);
        return view('livewire.admin.users.user-list', compact('users'));
    }
}
