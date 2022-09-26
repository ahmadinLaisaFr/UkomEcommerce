<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class HeaderSearchComponent extends Component
{
    public $search;
    public $category;
    public $category_id;

    public function mount()
    {
        $this->category = "All Product";
        $this->fill(request()->only('search', 'category', 'category_id'));
    }

    public function render()
    {
        $mydata['categories'] = Category::all();
        return view('livewire.header-search-component', $mydata);
    }
}
