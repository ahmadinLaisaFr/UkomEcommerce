<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{

    public function moveToCart($rowId, $product_id, $product_name, $product_price)
    {
        // dd($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success', 'Success adding item to cart!');
        return redirect()->route('products.cart');
    }

    public function destroy($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        session()->flash('success', 'item deleted !');
        return redirect()->route('products.wishlist');
    }
    public function destroyAll()
    {
        Cart::instance('wishlist')->destroy();
        session()->flash('success', 'All item deleted !');
        return redirect()->route('products.wishlist');
    }

    public function render()
    {
        return view('livewire.wishlist-component')->layout("layouts.base");
    }
}
