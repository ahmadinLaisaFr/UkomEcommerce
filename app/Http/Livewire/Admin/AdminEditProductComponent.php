<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditProductComponent extends Component
{
    public $product;
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
    public $newImage;
    use WithFileUploads;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->slug = $product->slug;
        $this->shortDesc = $product->short_desc;
        $this->desc = $product->desc;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->SKU;
        $this->stock = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function save(){

        $image = '';
        $arrUpdate = [];
        $validatedData = '';

        
        if ($this->slug == $this->product->slug) {
            $validatedData = $this->validate([
                'name' => 'required|max:32',
                'slug' => 'required',
                'regular_price' => 'required',
            ]);
        }else{
            $validatedData = $this->validate([
                'name' => 'required|max:32',
                'slug' => 'required|unique:products',
                'regular_price' => 'required',
            ]);
        }
        
        if (!empty($this->newImage)) {
            // nama gambar
            $image = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('products', $image);

            $arrUpdate = [
                'name' => $this->name,
                'category_id' => $this->category_id,
                'slug' => $this->slug,
                'short_desc' => $this->shortDesc,
                'desc' => $this->desc,
                'regular_price' => $this->regular_price,
                'sale_price' => $this->sale_price,
                'sku' => $this->sku,
                'stock' => $this->stock,
                'featured' => $this->featured,
                'quantity' => $this->quantity,
                'image' => $image
            ];
        }else{
            $arrUpdate = [
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
            ];
        }
        
        if ($validatedData) {
            if (Product::find($this->product->id)->update($arrUpdate)) {
                session()->flash('success', 'Success updating product');
                return redirect()->route('admin.product');
                // return redirect()->back()->with('updateArr', $arrUpdate); //debug
            }else{
                session()->flash('failed', 'Failed updating product');
                return redirect()->route('admin.product');
            }
        }else{
            return redirect()->route('admin.update.product');
        }
    }

    public function render()
    {
        $title['title'] = "Admin Page | Edit Product";
        $mydata['categories'] = Category::all();
        return view('livewire.admin.admin-edit-product-component', $mydata)->layout('layouts.base', $title);
    }
}
