<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function save(){

        $validatedData = $this->validate([
            'name' => 'required|max:32|unique:categories',
            'slug' => 'required|unique:categories',
        ]);
        if (Category::create($validatedData)) {
            session()->flash('success', 'Success adding category');
            return redirect()->route('admin.category');
        }else{
            session()->flash('failed', 'Failed adding category');
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
        $title['title'] = "Admin | Add Category";
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base', $title);
    }
}
