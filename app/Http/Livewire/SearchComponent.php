<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $search;
    public $category;
    public $category_id;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pagesize = 12;
        $this->fill(request()->only('search', 'category', 'category_id'));
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
            $mydata['products'] = Product::where('name', 'like', '%'.$this->search.'%')->orWhere('category_id', $this->category_id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $mydata['products'] = Product::where('name', 'like', '%'.$this->search.'%')->orWhere('category_id', $this->category_id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $mydata['products'] = Product::where('name', 'like', '%'.$this->search.'%')->orWhere('category_id', $this->category_id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $mydata['products'] = Product::where('name', 'like', '%'.$this->search.'%')->orWhere('category_id', $this->category_id)->paginate($this->pagesize);
        }
        $mydata['categories'] = Category::all();
        return view('livewire.search-component', $mydata)->layout('layouts.base', $mydata);
    }
}
