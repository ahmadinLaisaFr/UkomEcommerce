<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\HomeCategory;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $product_count;

    public function mount()
    {
        $categories = HomeCategory::find(1);
        $this->selected_categories = explode(',', $categories->select_categories);
        $this->product_count = $categories->product_count;
    }

    public function update()
    {
        $arrUpdate = [
            'select_categories' => implode(',', $this->selected_categories),
            'product_count' => $this->product_count
        ];
        $category = HomeCategory::find(1);
        if ($category->update($arrUpdate)) {
            session()->flash('success', 'success updating home categories');
            return redirect(route('admin.home.categories'));
        }else{
            session()->flash('failed', 'failed updating home categories');
            return redirect(route('admin.home.categories'));
        }
    }   

    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    public function render(){
        $title['title'] = "Admin Page | Home Category";
        $mydata['categories'] = Category::all();
        return view('livewire.admin.admin-home-category-component', $mydata)->layout("layouts.base", $title);
    }
}
