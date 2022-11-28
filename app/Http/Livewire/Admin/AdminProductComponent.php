<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use livewire\withPagination;

class AdminProductComponent extends Component
{
    public function delete($slug)
    {
        if (Product::where('slug', $slug)->delete()) {
            session()->flash('success', 'Success deleting product');
            return redirect()->route('admin.product');
        }else{
            session()->flash('failed', 'Failed deleting product');
            return redirect()->route('admin.product');
        }
        return redirect()->route('admin.product');
    }

    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    use withPagination;
    public function render()
    {
        $title['title'] = "Admin Page | Product";
        $mydata['products'] = Product::with('category')->latest()->paginate(5);
        return view('livewire.admin.admin-product-component', $mydata)->layout("layouts.base", $title);
    }
}
