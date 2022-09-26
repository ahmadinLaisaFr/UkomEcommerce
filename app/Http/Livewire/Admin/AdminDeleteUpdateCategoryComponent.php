<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminDeleteUpdateCategoryComponent extends Component
{
    public $category;
    public $name;
    public $slug;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function update()
    {
        $category = Category::where("slug", $this->category->slug);
        if ($category->update(
            [
                'name' => $this->name,
                'slug' => $this->slug,
            ]
        )) {
            session()->flash('success', 'Success updating category');
            return redirect()->route('admin.category');
        }else{
            session()->flash('failed', 'Failed updating category');
            return redirect()->route('admin.category');
        }
        return redirect()->route('admin.category');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        $title['title'] = "Admin | Update Category";
        $mydata['category'] = $this->category;
        return view('livewire.admin.admin-delete-update-category-component', $mydata)->layout('layouts.base', $title);
    }
}
