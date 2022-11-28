<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddSliderComponent extends Component
{
    public $title;
    public $subtitle;
    public $price;
    public $status;
    public $link;
    public $image;
    use WithFileUploads;

    public function mount()
    {
        $this->status = 0;
    }

    public function save()
    {
        $arrInsert = [];

        $validatedData = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'status' => 'required',
            'link' => 'required',
            'image' => 'required',
        ]);

        // image 
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders', $imageName);

        $arrInsert = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'price' => $this->price,
            'status' => $this->status,
            'link' => $this->link,
            'image' => $imageName,
        ];

        if ($validatedData) {
            if (Slider::create($arrInsert)) {
                session()->flash('success', 'Slider inserted successfully');
                return redirect()->route('admin.sliders');
            }else{
                session()->flash('failed', 'Failed adding slider');
                return redirect()->route('admin.sliders');
            }
        }else{
            return redirect()->route('admin.add.slider');
        }
    }

    public function render()
    {
        $title['title'] = "Admin Page | Add Slider";
        return view('livewire.admin.admin-add-slider-component')->layout('layouts.base', $title);
    }
}
