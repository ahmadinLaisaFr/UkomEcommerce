<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $tes;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success', 'Success adding item to cart!');
        return redirect()->route('products.cart');
    }

    public function render()
    {
        $product = new Product;
        $singleProduct = $product->where('slug', $this->slug)->first();
        $mydata['product'] = $singleProduct;
        $mydata['popular_products'] = $product->inRandomOrder()->limit(4)->get();
        $mydata['related_products'] = $product->where('category_id', $singleProduct->category_id)->inRandomOrder()->get();
        $mydata['sale_period'] = Sale::find(1);
        return view('livewire.details-component', $mydata)->layout('layouts.base');
    }
}
