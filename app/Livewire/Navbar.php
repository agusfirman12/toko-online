<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Attributes\On;
use App\Models\Transaction_detile;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $categories;

    public $totalItems = 0;

    
    #[On('cartUpdated')]
    public function updateCart(){
        if(Auth::user()){            
            $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if($transactions){
                $this->totalItems = Transaction_detile::where('transaction_id', $transactions->id)->count();
            }else{
                $this->totalItems = 0;
            }
        }
    }

    public function mount()
    {
        $this->categories = Category::all();

        if(Auth::user()){            
            $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if($transactions){
                $this->totalItems = Transaction_detile::where('transaction_id', $transactions->id)->count();
            }
        }
    }

    public function render()
    {
        return view('layouts.navbar');
    }
}
