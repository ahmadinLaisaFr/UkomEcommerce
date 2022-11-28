<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserUpdateProfileComponent extends Component
{
    // file upload trait
    use WithFileUploads;

    public $profile;
    public $user;
    public $complete_name;
    public $email;
    public $phone_number;
    public $address;
    public $city;
    public $country;
    public $post_code;
    public $image;
    public $new_image;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->user = $profile->user;
        $this->complete_name = $profile->user->name;
        $this->email = $profile->user->email;
        $this->phone_number = $profile->phone_number;
        $this->address = $profile->address;
        $this->country = $profile->country;
        $this->city = $profile->city;
        $this->post_code = $profile->post_code;
        $this->image = $profile->image;
    }

    public function updated($fields)
    {
        if ($this->email == $this->user->email) {
            $this->validateOnly($fields, [
            'complete_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'new_image' => 'required|mimes:jpg,jpeg,png'
        ]);
        }else {
            $this->validateOnly($fields, [
                'complete_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'address' => 'required',
                'country' => 'required',
                'city' => 'required',
                'post_code' => 'required',
                'new_image' => 'required|mimes:jpg,jpeg,png'
            ]);
        }

    }

    public function save()
    {
        $arrUpdateUser = [
            'name' => $this->complete_name,
            'email' => $this->email,
        ];

        $image = null;

        if (!empty($this->new_image)) {
            $image = Carbon::now()->timestamp.'.'.$this->new_image->extension();
            $this->new_image->storeAs('profile_picture', $image);
        }

        if ($this->image) {
            $image = $this->image;
        }


        $arrUpdateProfile = [
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            'post_code' => $this->post_code,
            'image' => $image
        ];

        if ($this->profile->update($arrUpdateProfile) && $this->user->update($arrUpdateUser)) {
            session()->flash('success', 'Profile updated successfully');
            return redirect(route('profile.show'));
        }else{
            session()->flash('failed', 'Failed when updating profile, try again');
            return redirect(route('profile.show'));
        }
    }

    public function render()
    {
        return view('livewire.user.user-update-profile-component')->layout('layouts.base');
    }
}
