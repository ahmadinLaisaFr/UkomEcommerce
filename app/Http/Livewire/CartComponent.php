<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public function increaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
    Cart::update($rowId, $qty);
    }

    public function decreaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success', 'Deleting success !');
        return redirect()->route('products.cart');
    }

    public function destroyAll()
    {
        Cart::destroy();
        session()->flash('success', 'All item deleted !');
        return redirect()->route('products.cart');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
