<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Home extends Component
{
    public function render()
    {
        $products = Product::take(4)->get();
        $categories = Category::take(4)->get();
        return view('livewire.home', compact('products', 'categories'));
    }
}
