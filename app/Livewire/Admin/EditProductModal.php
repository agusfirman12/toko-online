<?php

namespace App\Livewire\Admin;


use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


class EditProductModal extends Component
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


    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.edit-product-modal', compact('categories'));
    }
}
