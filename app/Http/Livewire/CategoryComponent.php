<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    public $slug;
    public $sorting;
    public $pagesize;

    public function mount($slug)
    {
    $this->slug = $slug;
    $this->sorting = 'default';
    $this->pagesize = 12;
    }

    public function render()
    {
        $category = Category::where('slug', $this->slug)->first();

        $mydata['title'] = "Category | $category->name";
        $mydata['category'] = $category;
        if($this->sorting == 'date'){
            $mydata['products'] = $category->product()->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $mydata['products'] = $category->product()->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $mydata['products'] = $category->product()->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $mydata['products'] = $category->product()->paginate($this->pagesize);
        }

        $mydata['categories'] = Category::all();
        return view('livewire.category-component', $mydata)->layout("layouts.base", $mydata);
    }
}
