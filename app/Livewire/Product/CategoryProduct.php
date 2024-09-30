<?php

namespace App\Livewire\product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class CategoryProduct extends Component
{
    use WithPagination,WithoutUrlPagination;

        public $search, $category;

        protected $updateQueryString = ['search'];

        public function updatingSearch()
        {
            $this->resetPage();
        }

        public function mount($id){
            $category = Category::find($id);
            
            if($category){
                $this->category = $category;
            }
        }

        public function render()
        {
            if ($this->search) {
                $products = Product::where('category_id', $this->category->id)->where('name', 'like', '%' . $this->search . '%')->paginate(4);
            }else{
                $products = Product::where('category_id', $this->category->id)->paginate(4);
            }

            $title = 'Product '.$this->category->name;

            return view('livewire.product.index', compact('products', 'title'), );
        }
}
