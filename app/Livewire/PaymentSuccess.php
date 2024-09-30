<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class PaymentSuccess extends Component
{
    public function render()
    {
        $transactions = Transaction::where('id', request()->id)->first();
        $transactions->status = 1;
        $transactions->update();
        
        return view('livewire.payment-success');
    }
}
