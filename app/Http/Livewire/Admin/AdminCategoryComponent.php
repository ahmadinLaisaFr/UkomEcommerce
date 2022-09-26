<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use livewire\withPagination;

class AdminCategoryComponent extends Component
{   
    public function delete($slug)
    {
        if (Category::where('slug', $slug)->delete()) {
            session()->flash('success', 'Success deleting category');
            return redirect()->route('admin.category');
        }else{
            session()->flash('failed', 'Failed deleting category');
            return redirect()->route('admin.category');
        }
        return redirect()->route('admin.category');
    }

    use withPagination;
    public function render()
    {
        $title['title'] = "Admin Page | Category"; 
        $mydata['categories'] = Category::latest()->paginate(5);
        return view('livewire.admin.admin-category-component', $mydata)->layout('layouts.base', $title);
    }
}
