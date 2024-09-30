<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination,WithoutUrlPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->paginate(4);
        }else{
            $products = Product::paginate(4);
        }

        $title = 'All Products';

        return view('livewire.product.index', compact('products', 'title'));
    }
}
