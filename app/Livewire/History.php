<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class History extends Component
{
    public $transactions, $detile;

    public function mount(){
        if(Auth::user()){
            $this->transactions = Transaction::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();
        }else{
            return redirect()->route('login');
        }
    }

    public function render()
    {
        
        return view('livewire.history');
    }
}
