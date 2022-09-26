<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use livewire\withPagination;

class AdminProductComponent extends Component
{
    use withPagination;
    public function render()
    {
        $title['title'] = "Admin Page | Product";
        $mydata['products'] = Product::latest()->paginate(5);
        return view('livewire.admin.admin-product-component', $mydata)->layout("layouts.base", $title);
    }
}
