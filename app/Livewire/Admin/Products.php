<?php

namespace App\Livewire\Admin;


use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;



#[Layout('Layouts.dashboard')]
class Products extends Component
{   
    public function render(){
        return view('livewire.admin.products');
    }
}
