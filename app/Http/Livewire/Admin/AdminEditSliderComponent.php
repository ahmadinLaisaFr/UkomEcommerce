<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditSliderComponent extends Component
{
    // public $slider_id;
    public $slider; //instansi slider yang akan diupdate
    public $title;
    public $subtitle;
    public $price;
    public $status;
    public $link;
    public $image;
    public $newImage;
    use WithFileUploads;

    public function mount(Slider $slider)
    {
        $this->slider = $slider;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->status = $slider->status;
        $this->link = $slider->link;
        $this->image = $slider->image;
    }

    public function save()
    {
        $arrUpdate = [];
        $image = '';

        $validatedData = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'status' => 'required',
            'link' => 'required',
        ]);

        if (!empty($this->newImage)) {
            // nama gambar
            $image = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('sliders', $image);

            $arrUpdate = [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'price' => $this->price,
                'status' => $this->status,
                'link' => $this->link,
                'image' => $image,
            ];
        }else{
            $arrUpdate = [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'price' => $this->price,
                'status' => $this->status,
                'link' => $this->link,
            ];
        }

        if ($validatedData) {
            if (Slider::find($this->slider->id)->update($arrUpdate)) {
                session()->flash('success', 'Slider updated successfully');
                return redirect()->route('admin.sliders');
            }else{
                session()->flash('success', 'Failed updating slider');
                return redirect()->route('admin.sliders');
            }
        } else {
            return redirect()->route('admin.update.slider');
        }
        
    }

    public function render()
    {
        $title['title'] = "Admin Page | Edit Slider";
        $mydata = [];
        // $mydata['slider'] = $this->slider;
        return view('livewire.admin.admin-edit-slider-component', $mydata)->layout('layouts.base', $title);
    }
}
