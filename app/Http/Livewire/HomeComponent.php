<?php

namespace App\Http\Livewire;

use App\Models\Slider;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\Sale;

class HomeComponent extends Component
{
    public function render()
    {
        $category = HomeCategory::find(1);
        $arrSelected = explode(',', $category->select_categories);
        $prod_count = $category->product_count;
        $title['title'] = "Home Page";
        $mydata['sliders'] = Slider::where('status', 1)->latest()->get();
        $mydata['latests'] = Product::latest()->limit(8)->get();
        $mydata['categories'] = Category::whereIn('id', $arrSelected)->get();
        $mydata['category_products'] = Product::whereIn('category_id', $arrSelected)->limit($prod_count)->get();
        $mydata['product_count'] = $prod_count;
        $mydata['sale_period'] = Sale::find(1);
        $mydata['sale_product'] = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component', $mydata)->layout('layouts.base', $title);
    }
}
