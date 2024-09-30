<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{

    public $price_total;

    public $id;

    public $snaps_token;

    #[Validate('required','numeric')] 
    public $handphone;

    #[Validate('required')]
    public $address;

    public function mount()
    {
        if(!Auth::user()){
            return redirect()->route('login');
        }

        $this->handphone = Auth::user()->handphone;
        $this->address = Auth::user()->address;

        $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($transactions)){
            $this->price_total = $transactions->price_total;
            $this->snaps_token = $transactions->snaps_token;
            $this->id = $transactions->id;
        }else{
            return redirect()->route('home');
        }
    }

    public function checkout(){


        $user = User::find(Auth::id());
        $user->update($this->validate());

        $this->dispatch('cartUpdated');

        session()->flash('success', 'Berhasil checkout!');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
