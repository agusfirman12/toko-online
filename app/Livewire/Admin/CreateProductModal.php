<?php

namespace App\Livewire\admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CreateProductModal extends Component
{

    use WithFileUploads;

    #[Validate('required')]
    public $category_id;

    #[Validate('image|max:1024')]
    public $image;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $description;

    #[Validate('required')]
    public $weight;

    public function save(){
        $this->validate();

        $filePath = $this->image->storeAs('productImage', $this->image->getClientOriginalName());
        
        Product::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'weight' => $this->weight,
            'image' => $filePath
        ]);
        
        $this->reset();

        session()->flash('success', 'Product created successfully');

        $this->dispatch('updateListProducts');
        
    }

    public function render()
    {
        $category = Category::all();
        return view('livewire.admin.create-product-modal', ['categories' => $category]);
    }
}
