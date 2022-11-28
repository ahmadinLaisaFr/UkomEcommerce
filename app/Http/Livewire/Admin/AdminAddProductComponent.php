<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    public $shortDesc;
    public $desc;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock;
    public $featured;
    public $quantity;
    public $image;
    use WithFileUploads;

    public function mount()
    {
        $this->stock = 'instock';
        $this->featured = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function save()
    {
        $arrInsert = [];

        $validatedData = $this->validate([
            'name' => 'required|max:32',
            'slug' => 'required|unique:products',
            'regular_price' => 'required',
        ]);

        // image 
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products', $imageName);

        $arrInsert = [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'short_desc' => $this->shortDesc,
            'desc' => $this->desc,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'SKU' => $this->sku,
            'stock' => $this->stock,
            'featured' => $this->featured,
            'quantity' => $this->quantity,
            'image' => $imageName
        ];

        if ($validatedData) {
            if (Product::create($arrInsert)) {
                session()->flash('success', 'Success adding product');
                return redirect()->route('admin.product');
                // return redirect()->back()->with('updateArr', $arrUpdate); //debug
            }else{
                session()->flash('failed', 'Failed adding product');
                return redirect()->route('admin.product');
            }
        }
    }

    public function render()
    {
        $title['title'] = "Admin Page | Add Product";
        $mydata['categories'] = Category::all();
        return view('livewire.admin.admin-add-product-component', $mydata)->layout('layouts.base', $title);
    }
}
