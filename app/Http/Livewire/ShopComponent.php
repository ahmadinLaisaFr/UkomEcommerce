<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pagesize = 12;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success', 'Success adding item to cart!');
        return redirect()->route('products.cart');
    }

    use WithPagination;
    public function render()
    {
        $mydata['title'] = 'Shop';
        if ($this->sorting == 'date') {
            $mydata['products'] = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $mydata['products'] = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $mydata['products'] = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $mydata['products'] = Product::paginate($this->pagesize);
        }
        $mydata['categories'] = Category::all();
        return view('livewire.shop-component', $mydata)->layout('layouts.base', $mydata);
    }
}
