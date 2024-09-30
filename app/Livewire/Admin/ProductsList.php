<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ProductsList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $name, $price, $description, $weight, $image;
    public $category_id;

    // Fungsi untuk menghapus produk
    public function deleteProducts($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();

            // Emit event untuk memicu update data di frontend
            $this->dispatch('updateListProducts');
            
            // Flash message
            session()->flash('delete-message', 'Product deleted successfully.');
            
        }
    }

    public function loadProduct($id){
        $product = Product::find($id);
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->weight = $product->weight;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
    }

    #[On('updateListProducts')]
    public function render()
    {
        $products = Product::with('category')->paginate(3);
        return view('livewire.admin.products-list', compact('products'));
    }
}
