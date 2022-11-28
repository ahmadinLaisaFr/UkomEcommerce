<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\withPagination;

class AdminSliderComponent extends Component
{
    use withPagination;

    public function delete($id)
    {
        if (Slider::find($id)->delete()) {
            session()->flash('success', 'Success deleting slider');
            return redirect()->route('admin.sliders');
        }else{
            session()->flash('failed', 'Failed deleting sliders');
            return redirect()->route('admin.sliders');
        }
        return redirect()->route('admin.sliders');
    }

    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    public function render()
    {
        $title['title'] = "Admin Page | Sliders";
        $mydata['sliders'] = Slider::latest()->paginate(5);
        return view('livewire.admin.admin-slider-component', $mydata)->layout('layouts.base', $title);
    }
}
