<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Layout;

#[Layout('Layouts.dashboard')]

class Dashboard extends Component
{
    public function render()
    {
        $user = User::all()->count();
        $products = Product::all()->count();
        $transactions = Transaction::all()->count();
        return view('livewire.admin.dashboard', ['user' => $user, 'products' => $products, 'transactions' => $transactions]);
    }
}
