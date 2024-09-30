<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Transaction_detile;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    protected $transactions;
    protected $transactions_detile = [];

    public function delete($id){
        $transactions_detile = Transaction_detile::find($id);
        
        if(!empty($transactions_detile)){
            $transactions = Transaction::where('id', $transactions_detile->transaction_id)->first();
            $total_transactions_detile = Transaction_detile::where('transaction_id', $transactions->id)->count();
            if($total_transactions_detile == 1){
                $transactions->delete();
            }else{
                $transactions->price_total = $transactions->price_total - $transactions_detile->price_total;
                $transactions->update();
            }

            $transactions_detile->delete();

        }
        $this->dispatch('cartUpdated');

        session()->flash('successDeleteCart', 'Cart Item Deleted!');
    }

    public function render()
    {
        if(Auth::user()){
            $this->transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if($this->transactions){
                $this->transactions_detile = Transaction_detile::where('transaction_id', $this->transactions->id)->get();
            }
        }
        return view('livewire.cart',[
            'transactions' => $this->transactions,
            'transactions_detiles' => $this->transactions_detile
        ]);
    }
}
